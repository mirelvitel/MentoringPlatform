<script setup>
import {ref} from 'vue';
import AppLayout from "@/Layouts/AppLayout.vue";
import NavLeft from "@/Shared/NavLeft.vue";
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import Multiselect from 'vue-multiselect'

const isMobile = ref(window.innerWidth < 640)
const fullCalendar = ref(null)
const calendarOptions = ref({
    plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
    initialView: isMobile.value ? 'timeGridDay' : 'timeGridWeek',
    //dateClick: handleDateClick,
    headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'timeGridDay,timeGridWeek,dayGridMonth',
    },
    events: [],
    slotDuration: '00:30:00',
    slotLabelInterval: '00:30:00',
    slotMinTime: '07:00:00',
    slotMaxTime: '20:00:00',
    slotLabelFormat: {
        hour: '2-digit',
        minute: '2-digit',
        omitZeroMinute: false,
        meridiem: false,
        hour12: false
    },
    editable: true,
    selectable: true,
    selectMirror: true,
    dayMaxEvents: true,
    weekends: true,
    select: handleDateSelect,
    eventClick: handleEventClick,
    eventsSet: handleEvents,
    locale: 'de',
    height: 650
})
const currentEvents = ref([])
const showForm = ref(false)
const event = ref({
    title: '',
    description: '',
    start: '',
    end: '',
    allDay: false,
    invitedUsers: []
})

//hardcoded users for testing!
const users = ref([
    { id: 1, name: 'John Doe', role: 'admin' },
    { id: 2, name: 'Jane Smith', role: 'mentor' },
    { id: 3, name: 'Sara Connor', role: 'mentee' },
    { id: 4, name: 'Mike Tyson', role: 'mentee' },
    { id: 5, name: 'Michael Sun', role: 'mentee' },
])
// Manage selection of users by role
const roleSelection = ref({
    admin: false,
    mentor: false,
    mentee: false
});

function handleDateSelect(selectInfo) {
    console.log('handleDateSelect')
    showForm.value = true

    console.log(selectInfo)
    event.value.start = selectInfo.startStr.split('T')[0]
    event.value.startTime = new Date(selectInfo.start).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
    let calendarApi = selectInfo.view.calendar
    calendarApi.unselect()
}

function handleEventClick(clickInfo) {
    console.log('handleEventClick')

    const event = clickInfo.event._def
    const time = event.extendedProps.eventTime

    console.log(event, time)
}

function handleEvents(events) {
    currentEvents.value = events
}

function resetEventForm() {
    event.value = {
        title: '',
        description: '',
        start: '',
        end: '',
        allDay: false,
        invitedUsers: []
    };
    roleSelection.value = {
        admin: false,
        mentor: false,
        mentee: false
    };
    showForm.value = false;
}

function autoGrow(event) {
    const textarea = event.target;
    textarea.style.height = 'auto';
    textarea.style.height = (textarea.scrollHeight) + 'px';
}

function toggleRole(event, role) {
    // Update the role selection based on the checkbox state
    roleSelection.value[role] = event.target.checked;

    if (roleSelection.value[role]) {
        addUsersByRole(role);
    } else {
        removeUsersByRole(role);
    }
}

function addUsersByRole(role) {
    const usersByRole = users.value.filter(user => user.role === role);
    event.value.invitedUsers = [...new Set([...event.value.invitedUsers, ...usersByRole])];
}

function removeUsersByRole(role) {
    event.value.invitedUsers = event.value.invitedUsers.filter(user => user.role !== role);
}

</script>

<template>

    <AppLayout>

        <div class="flex">
            <NavLeft/>

            <div class="posts mx-6 content-width--200 bg-gray-200 px-2 relative">
                <h1 class="text-xl text-gray-500">Calendar</h1>

                <FullCalendar ref="fullCalendar" :options="calendarOptions"/>

                <div v-if="showForm" class="absolute flex items-center justify-center bg-gray-800 inset-0 z-50 bg-opacity-50">
                    <div class="flex flex-col p-6 bg-white shadow rounded">
                        <div class="flex items-center mb-4">
                            <label for="date" class="w-32">Date:</label>
                            <input type="date" v-model="event.start" class="w-[400px]" placeholder="Title">
                        </div>

                        <div class="flex items-center mb-4">
                            <label for="allDay" class="w-32">All-Day:</label>
                            <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                <input type="checkbox" v-model="event.allDay" id="allDay" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"/>
                                <label for="allDay" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                            </div>
                        </div>

                        <div v-if="!event.allDay">
                            <div class="flex items-center mb-4">
                                <label for="startTime" class="w-32">Start Time:</label>
                                <input type="text" v-model="event.startTime" class="w-[400px]" placeholder="Start Time">
                            </div>

                            <div class="flex items-center mb-4">
                                <label for="endTime" class="w-32">End Time:</label>
                                <input type="text" class="w-[400px]" placeholder="End Time">
                            </div>
                        </div>

                        <!-- Role selection with checkboxes -->
                        <div class="flex items-center mb-4">
                            <label for="roleSelection" class="w-32">Add all:</label>
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center">
                                    <input type="checkbox" id="admin" :checked="roleSelection.admin" @change="event => toggleRole(event, 'admin')" />
                                    <label for="admin" class="ml-2">Admins</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="mentor" :checked="roleSelection.mentor" @change="event => toggleRole(event, 'mentor')" />
                                    <label for="mentor" class="ml-2">Mentors</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="mentee" :checked="roleSelection.mentee" @change="event => toggleRole(event, 'mentee')" />
                                    <label for="mentee" class="ml-2">Mentees</label>
                                </div>
                            </div>
                        </div>

                        <!-- Invite Users Multiselect -->
                        <div class="flex items-center mb-4">
                            <label for="invitedUsers" class="w-32">Invite Users:</label>
                            <Multiselect v-model="event.invitedUsers"
                                         :options="users"
                                         :multiple="true"
                                         placeholder="Type to search..."
                                         label="name"
                                         track-by="id"
                                         class="multiselect-wrap p-2 border border-gray-300 rounded"
                                         
                                         />
                        </div>

                        
                        <div class="flex items-center mb-4">
                            <label for="description" class="w-32">Description:</label>
                            <textarea v-model="event.description"
                                      class="w-[400px] p-2 border border-gray-300 rounded resize-none"
                                      placeholder="Description"
                                      rows="3"
                                      @input="autoGrow"></textarea>
                        </div>
                        
                        <button class="bg-blue-500 text-white">Add</button>
                        <button @click="resetEventForm" class="bg-zinc-400 text-white mt-2">Close</button>
                    </div>
                </div>

            </div>
        </div>

    </AppLayout>

</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
<style scoped>
/* All-day toggle switch styles */
.toggle-checkbox:checked {
    right: 0;
    border-color: #2563EB; /* Tailwind's blue-500 */
}
.toggle-checkbox:checked + .toggle-label {
    background-color: #2563EB;
}
.toggle-label {
    width: 2.5rem;
    height: 1.5rem;
}
/* Enable wrapping for the Multiselect component */
.multiselect-wrap {
    width: 400px;
    white-space: normal;
    overflow: visible;
    height: auto;
}

/* Additional fix to ensure dropdown is properly displayed */
.multiselect__content {
    max-height: 200px;
    overflow-y: auto;
}
</style>