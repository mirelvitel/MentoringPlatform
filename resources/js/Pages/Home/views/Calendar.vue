<script setup>
import {ref, computed} from 'vue';
import axios from 'axios';
import MultiSelect from 'vue-multiselect';
import AppLayout from "@/Layouts/AppLayout.vue";
import NavLeft from "@/Shared/NavLeft.vue";
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import {PencilSquareIcon, TrashIcon, XMarkIcon} from "@heroicons/vue/20/solid/index.js";
import {usePage} from "@inertiajs/vue3";


const isMobile = ref(window.innerWidth < 640)
const fullCalendar = ref(null)
const showForm = ref(false)
const event = ref({
    id: null,
    title: '',
    date: '',
    description: '',
    start: '',
    end: '',
    invitedUsers: [],
})
const selectedRole = ref([]);
const selectedFaculty = ref([]);
const selectedSemester = ref([]);
const selectedGroup = ref([]);
const userSearchQuery = ref('');
const props = defineProps({
    events: {
        type: Array,
        required: true,
    },
    users: {
        type: Array,
        required: true,
    },
    faculties: {
        type: Array,
        required: true,
    },
});
const currentEvents = ref([...props.events]);
const calendarOptions = ref({
    plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
    initialView: isMobile.value ? 'timeGridDay' : 'timeGridWeek',
    //dateClick: handleDateClick,
    headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'timeGridDay,timeGridWeek,dayGridMonth',
    },
    events: currentEvents.value,
    slotDuration: '00:30:00',
    slotLabelInterval: '00:30:00',
    slotMinTime: '08:00:00',
    slotMaxTime: '19:00:00',
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
    height: 650,
    eventContent: function (info) {
        return {html: `<div class="fc-event-title font-bold px-1">${info.event.title}</div>`};
    },
})
const showModal = ref(false);
const selectedEvent = ref(null);
const page = usePage();
const user = computed(() => page.props.auth.user);
const activeSection = ref('details');
const filteredUsers = computed(() => {
    return props.users.filter(user => {
        const matchesRole = !selectedRole.value.length || selectedRole.value.includes(user.role);
        const matchesFaculty = !selectedFaculty.value.length || selectedFaculty.value.some(faculty => faculty.id === user.faculty_id);
        const matchesSemester = !selectedSemester.value.length || selectedSemester.value.includes(user.semester);
        const matchesGroup = !selectedGroup.value.length || selectedGroup.value.includes(user.group);
        const matchesSearch = !userSearchQuery.value || user.name.toLowerCase().includes(userSearchQuery.value.toLowerCase());

        return matchesRole && matchesFaculty && matchesSemester && matchesGroup && matchesSearch;
    });
});
function selectAllUsers() {
    event.value.invitedUsers = [...filteredUsers.value];
}
function handleDateSelect(selectInfo) {
    resetEventForm();
    event.value.start = formatTime(selectInfo.start);
    event.value.end = formatTime(selectInfo.end);
    event.value.date = formatDate(selectInfo.start);
    showForm.value = true;
    let calendarApi = selectInfo.view.calendar;
    calendarApi.unselect();
}
function formatTime(date) {
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    return `${hours}:${minutes}`;
}
function formatDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}
function handleEventClick(clickInfo) {
    selectedEvent.value = {
        id: clickInfo.event.id,
        title: clickInfo.event.title,
        start: clickInfo.event.start,
        end: clickInfo.event.end,
        description: clickInfo.event.extendedProps.description,
        createdAt: clickInfo.event.extendedProps.created_at,
        createdBy: clickInfo.event.extendedProps.created_by,
    };
    showModal.value = true;
}
function handleEvents(events) {
    currentEvents.value = events;
}
function resetEventForm() {
    event.value = {
        id: null,
        title: '',
        description: '',
        start: '',
        end: '',
        date: '',
        invitedUsers: [],
    };
    selectedRole.value = [];
    selectedFaculty.value = [];
    selectedSemester.value = [];
    selectedGroup.value = [];
    userSearchQuery.value = '';
    showForm.value = false;
}
function saveEvent() {
    const isEdit = event.value.id !== null;
    const startDateTime = `${event.value.date}T${event.value.start}:00`;
    const endDateTime = `${event.value.date}T${event.value.end}:00`;
    const invitedUserIds = event.value.invitedUsers.map(user => user.id);

    const requestPayload = {
        title: event.value.title,
        date: event.value.date,
        description: event.value.description,
        start: startDateTime,
        end: endDateTime,
        invitedUsers: invitedUserIds,
    };

    console.log('Request Payload:', requestPayload);

    const requestMethod = isEdit ? axios.put : axios.post;
    const requestUrl = isEdit ? `/calendar/event/${event.value.id}` : '/calendar/event';

    requestMethod(requestUrl, requestPayload)
        .then(response => {
            if (isEdit) {
                const index = props.events.findIndex(item => item.id === event.value.id);
                if (index !== -1) {
                    props.events[index] = response.data;
                }
                if (fullCalendar.value) {
                    const calendarApi = fullCalendar.value.getApi();
                    const calendarEvent = calendarApi.getEventById(event.value.id);
                    if (calendarEvent) {
                        calendarEvent.setProp('title', response.data.title);
                        calendarEvent.setStart(response.data.start);
                        calendarEvent.setEnd(response.data.end);
                        calendarEvent.setExtendedProp('description', response.data.description);
                    }
                }
            } else {
                props.events.push(response.data);
                if (fullCalendar.value) {
                    const calendarApi = fullCalendar.value.getApi();
                    calendarApi.addEvent(response.data);
                }
            }
            resetEventForm();
            showForm.value = false;
        })
        .catch(error => {
            console.error('Error saving event:', error);
        });
}
function closeModal() {
    showModal.value = false;
    selectedEvent.value = null;
}
function deleteEvent() {
    axios.delete(`/calendar/event/${selectedEvent.value.id}`).then(response => {
        if (response.status === 204) {
            if (fullCalendar.value) {
                const calendarApi = fullCalendar.value.getApi();
                const event = calendarApi.getEventById(selectedEvent.value.id);
                if (event) {
                    event.remove();
                }
            }
            console.log('Event deleted:', selectedEvent.value.id);
            currentEvents.value = currentEvents.value.filter(event => event.id !== selectedEvent.value.id);
            closeModal();
        }
    }).catch(error => {
        console.error('Error deleting event:', error);
    });
}
function editEvent() {
    event.value.id = selectedEvent.value.id;
    event.value.title = selectedEvent.value.title;
    event.value.date = formatDate(selectedEvent.value.start);
    event.value.start = formatTime(selectedEvent.value.start);
    event.value.end = formatTime(selectedEvent.value.end);
    event.value.description = selectedEvent.value.description;

    showModal.value = false;
    showForm.value = true;
}


</script>

<template>
    <AppLayout>
        <div class="flex">
            <NavLeft/>

            <div class="posts mx-6 content-width--200 bg-gray-200 px-2 py-2 relative">
                <FullCalendar ref="fullCalendar" :options="calendarOptions"/>
                <div v-if="showForm"
                     class="absolute flex items-center justify-center bg-gray-800 inset-0 z-50 bg-opacity-50">
                    <div class="flex flex-col p-6 bg-white shadow rounded w-[500px]">
                        <div class="mb-4">
                            <button
                                @click="activeSection = activeSection === 'details' ? '' : 'details'"
                                class="w-full flex justify-between px-4 py-2 text-left font-bold bg-gray-200 text-gray-700 focus:outline-none focus:bg-gray-300"
                            >
                                Event Details
                                <span v-if="activeSection === 'details'">-</span>
                                <span v-else>+</span>
                            </button>
                            <div v-if="activeSection === 'details'" class="p-4 bg-white border border-gray-300">
                                <div class="flex items-center mb-4">
                                    <label for="title" class="w-32">Title:</label>
                                    <input type="text" v-model="event.title" id="title" class="w-full"
                                           placeholder="Event Title">
                                </div>

                                <div class="flex items-center mb-4">
                                    <label for="date" class="w-32">Date:</label>
                                    <input type="text" v-model="event.date" id="date" class="w-full" placeholder="Date">
                                </div>

                                <div class="flex items-center mb-4">
                                    <label for="startTime" class="w-32">Start Time:</label>
                                    <input type="text" v-model="event.start" id="startTime" class="w-full"
                                           placeholder="Start Time">
                                </div>

                                <div class="flex items-center mb-4">
                                    <label for="endTime" class="w-32">End Time:</label>
                                    <input type="text" v-model="event.end" id="endTime" class="w-full"
                                           placeholder="End Time">
                                </div>

                                <div class="flex items-center mb-4">
                                    <label for="description" class="w-32">Description:</label>
                                    <textarea v-model="event.description" id="description"
                                              class="w-full p-2 border border-gray-300 rounded resize-none"
                                              placeholder="Description" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Filter & Invite Users Section -->
                        <div class="mb-4">
                            <button
                                @click="activeSection = activeSection === 'filters' ? '' : 'filters'"
                                class="w-full flex justify-between px-4 py-2 text-left font-bold bg-gray-200 text-gray-700 focus:outline-none focus:bg-gray-300"
                            >
                                Filter & Invite Users
                                <span v-if="activeSection === 'filters'">-</span>
                                <span v-else>+</span>
                            </button>
                            <div v-if="activeSection === 'filters'" class="p-4 bg-white border border-gray-300">

                                <div class="flex items-center mb-4">
                                    <label class="w-32">Role:</label>
                                    <MultiSelect v-model="selectedRole"
                                                 :options="['mentor', 'mentee']"
                                                 :multiple="true"
                                                 :close-on-select="false"
                                                 placeholder="Select Role">
                                        <template #selection="{ values, isOpen }">
                                            <span class="multiselect__single"
                                                  v-if="values.length"
                                                  v-show="!isOpen">
                                                {{ values.length }} options selected
                                            </span>
                                        </template>
                                    </MultiSelect>
                                </div>
                                <div class="flex items-center mb-4">
                                    <label class="w-32">Faculty:</label>
                                    <MultiSelect v-model="selectedFaculty" :options="faculties"
                                                 :multiple="true"
                                                 :close-on-select="false"
                                                 label="name"
                                                 track-by="id"
                                                 placeholder="Select Faculty">
                                        <template #selection="{ values, isOpen }">
                                            <span class="multiselect__single"
                                                  v-if="values.length"
                                                  v-show="!isOpen">
                                                {{ values.length }} options selected
                                            </span>
                                        </template>
                                    </MultiSelect>
                                </div>
                                <div class="flex items-center mb-4">
                                    <label class="w-32">Semester:</label>
                                    <MultiSelect v-model="selectedSemester" :options="[1, 2, 3, 4, 5, 6]"
                                                 :multiple="true"
                                                 :close-on-select="false"
                                                 placeholder="Select Semester">
                                        <template #selection="{ values, isOpen }">
                                            <span class="multiselect__single"
                                                  v-if="values.length"
                                                  v-show="!isOpen">
                                                {{ values.length }} options selected
                                            </span>
                                        </template>
                                    </MultiSelect>
                                </div>
                                <div class="flex items-center mb-4">
                                    <label class="w-32">Group:</label>
                                    <MultiSelect v-model="selectedGroup" :options="['A', 'B', 'C', 'D', 'E', 'F']"
                                                 :multiple="true"
                                                 :close-on-select="false"
                                                 placeholder="Select Group">
                                        <template #selection="{ values, isOpen }">
                                            <span class="multiselect__single"
                                                  v-if="values.length"
                                                  v-show="!isOpen">
                                                {{ values.length }} options selected
                                            </span>
                                        </template>
                                    </MultiSelect>
                                </div>
                                <div class="flex items-center mb-4">
                                    <label for="users" class="w-40">Invite Users:</label>
                                    <MultiSelect v-model="event.invitedUsers"
                                                 :options="filteredUsers"
                                                 :multiple="true"
                                                 :close-on-select="false"
                                                 track-by="id"
                                                 label="name"
                                                 :placeholder="`${filteredUsers.length} Users`">
                                        <template #selection="{ values, isOpen }">
                                            <span class="multiselect__single"
                                                  v-if="values.length"
                                                  v-show="!isOpen">
                                                {{ values.length }} options selected
                                            </span>
                                        </template>
                                    </MultiSelect>
                                    <button @click="selectAllUsers" class="ml-2 border-b-gray-400 bg-gray-200 hover:bg-gray-300 text-gray-500 px-2 text-sm rounded">
                                        Select All
                                    </button>
                                </div>
                            </div>
                        </div>


                        <!-- Save and Abort Buttons -->
                        <div class="flex justify-end">
                            <button @click="saveEvent"
                                    class="bg-secondary hover:bg-secondary_hover text-white px-4 py-2 mr-2">Save
                            </button>
                            <button @click="resetEventForm" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2">
                                Abort
                            </button>
                        </div>
                    </div>
                </div>

                <div v-if="showModal"
                     class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
                    <div class="bg-white p-6 rounded-lg shadow-lg relative">
                        <button @click="showModal = false"
                                class="absolute top-1 right-1 text-gray-600 hover:text-gray-900">
                            <XMarkIcon class="w-6 h-6"/>
                        </button>

                        <h2 class="text-lg font-bold">{{ selectedEvent.title }}</h2>
                        <p><strong>Start:</strong> {{ formatTime(selectedEvent.start) }}</p>
                        <p><strong>End:</strong> {{ formatTime(selectedEvent.end) }}</p>
                        <p><strong>Description:</strong> {{ selectedEvent.description }}</p>
                        <div v-if="selectedEvent.createdBy === user.id" class="flex">
                            <button @click="editEvent"
                                    class="flex items-center mt-2 px-2 py-2 text-primary bg-white border border-gray-300 rounded hover:bg-gray-200">
                                <PencilSquareIcon class="w-5 h-5 mr-2"/>
                                Edit
                            </button>
                            <button @click="deleteEvent"
                                    class="flex items-center mt-2 px-2 py-2 ml-2 text-red-500 bg-white border border-gray-300 rounded hover:bg-gray-200">
                                <TrashIcon class="w-5 h-5 mr-2"/>
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
