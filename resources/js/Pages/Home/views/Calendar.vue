<script setup>
import {ref} from 'vue';
import AppLayout from "@/Layouts/AppLayout.vue";
import NavLeft from "@/Shared/NavLeft.vue";
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'

const isMobile = ref(window.innerWidth < 640)
const fullCalendar = ref(null)
const calendarOptions = ref({
    plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
    initialView: isMobile.value ? 'timeGridDay' : 'dayGridWeek',
    //dateClick: handleDateClick,
    headerToolbar: {
        left: 'prev',
        center: 'title',
        right: 'next',
    },
    events: [],
    slotDuration: '00:30:00',
    slotLabelInterval: '00:30:00',
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
    locale: 'de'
})
const currentEvents = ref([])
const showForm = ref(false)
const event = ref({
    title: '',
    description: '',
    start: '',
    end: ''
})
function handleDateSelect(selectInfo) {
    console.log('handleDateSelect')
    showForm.value = true

    console.log(selectInfo)
    event.value.start = selectInfo.startStr
    //let calendarApi = selectInfo.view.calendar
    //calendarApi.unselect() //
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
                        <input type="date" v-model="event.start" class="w-[400px]" placeholder="Title">
                        <input type="text" class="w-[400px]" placeholder="Description">
                        <input type="text" class="w-[400px]" placeholder="Start Date">
                        <input type="text" class="w-[400px]" placeholder="End Date">
                        <button class="bg-blue-500 text-white">Add</button>
                        <button @click="showForm = false" class="bg-blue-500 text-white">Close</button>
                    </div>
                </div>

            </div>
        </div>

    </AppLayout>

</template>
