<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {computed, ref} from "vue";
import {PlusCircleIcon, PencilSquareIcon, TrashIcon} from "@heroicons/vue/20/solid";
import axios from "axios";
import {useToast} from "vue-toastification";

const toast = useToast();
import {usePage} from '@inertiajs/vue3'

const page = usePage()

// Define props
const props = defineProps({
    items: {
        type: Array,
        required: true
    },
});


const displayForm = ref(false)
const form = ref({
    question: '',
    answer: ''
})

function saveFaq() {
    axios.post('/help/faq', form.value)
        .then(response => {
            console.log(response.data)
            toast.success('FAQ saved successfully')
            props.items.push(response.data)
            displayForm.value = false
        })
        .catch(error => {
            console.log(error)
            toast.error('An error occurred while saving FAQ')
        })
}

function deleteFaq(item, idx) {
    if (!confirm('Are you sure you want to delete this FAQ?')) return

    axios.delete('/help/faq/' + item.id)
        .then(response => {
            toast.success('FAQ deleted successfully')
            props.items.splice(idx, 1)
        })
        .catch(error => {
            console.log(error)
            toast.error('An error occurred while deleting FAQ')
        })
}

const user = computed(() => page.props.auth.user)
</script>

<template>
    <AppLayout>
        <div>
            <div class="flex justify-between">
                <h1 class="text-4xl border-b border-primary w-fit">FAQ</h1>
                <button v-if="user.role === 'admin'" class="flex items-center space-x-2 text-primary font-semibold">
                    <PlusCircleIcon class="w-6 h-6"/>
                    <span @click="displayForm = true">Ask a question</span>
                </button>
            </div>

            <div class="mt-8 w-full">
                <section v-for="(item, idx) in items" class="w-full mt-4">
                    <details
                        class="w-full bg-white p-4 rounded-xl shadow-md group mx-auto overflow-hidden max-h-[56px] open:!max-h-[400px] transition-[max-height] duration-500 overflow-hidden">
                        <summary
                            class="outline-none cursor-pointer focus:underline focus:text-indigo-600 font-semibold marker:text-transparent group-open:before:rotate-90  before:origin-center relative before:w-[18px] before:h-[18px] before:transition-transform before:duration-200 before:-left-1 before:top-2/4 before:-translate-y-2/4 before:absolute before:bg-no-repeat before:bg-[length:18px_18px] before:bg-center before:bg-[url('data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20class%3D%22h-6%20w-6%22%20fill%3D%22none%22%20viewBox%3D%220%200%2024%2024%22%20stroke%3D%22currentColor%22%20stroke-width%3D%222%22%3E%0A%20%20%3Cpath%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20d%3D%22M9%205l7%207-7%207%22%20%2F%3E%0A%3C%2Fsvg%3E')]">
                            {{ item.question }}
                        </summary>

                        <hr class="my-2 scale-x-150"/>

                        <div class="text-sm -m-4 -mt-2 p-4 bg-gray-50 flex flex-col">
                            {{ item.answer }}

                            <div class="flex">
                                <PencilSquareIcon class="w-8 h-8 mt-4 hover:bg-gray-200 p-1 rounded text-primary cursor-pointer"
                                                  @click="displayForm = true; form = item"/>
                                <TrashIcon class="w-8 h-8 mt-4 ml-4 hover:bg-gray-200 p-1 rounded text-red-500 cursor-pointer" @click="deleteFaq(item, idx)"/>
                            </div>

                        </div>
                    </details>
                </section>
            </div>


            <div
                class="form fixed inset-0 bg-gray-800 bg-opacity-25 flex items-center justify-center"
                v-if="displayForm">
                <div class="bg-white shadow border border-primary p-12 rounded-lg min-w-[500px]">
                    <div class="form-group flex flex-col mb-4 w-full">
                        <label for="name">Question</label>
                        <input v-model="form.question" type="text" id="name" class="form-control">
                    </div>
                    <div class="form-group flex flex-col mb-4 w-full">
                        <label for="answer">Answer</label>
                        <textarea v-model="form.answer" id="answer" class="form-control"></textarea>
                    </div>

                    <button @click="saveFaq()"
                            class="bg-secondary py-1 text-white transition-all hover:bg-green-600 px-4 rounded">Save
                    </button>
                    <button @click="displayForm=false"
                            class="py-1 text-white ml-4 bg-red-500 transition-all hover:bg-red-600 px-4 rounded">Abort
                    </button>
                </div>
            </div>

        </div>

    </AppLayout>
</template>

