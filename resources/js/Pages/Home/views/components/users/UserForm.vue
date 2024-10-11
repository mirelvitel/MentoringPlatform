<script setup>
import { useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import { useToast } from "vue-toastification";
import axios from "axios";

const toast = useToast();

const form = useForm({
    first_name: "",
    last_name: "",
    email: "",
    role: "",
    terms: false,
});

const emit = defineEmits(["userAdded"]);

const submitForm = () => {
    // Combine first and last name into one "name" field
    const formData = {
        name: `${form.first_name} ${form.last_name}`,
        email: form.email,
        role: form.role,
        terms: form.terms,
    };
    axios
        .post("/users", formData)
        .then((response) => {
            toast.success("User added successfully");
            emit("userAdded", response.data);
            form.reset();
        })
        .catch((error) => {
            console.log(error.response.data);
            toast.error("Error adding user");
        });
};
</script>

<template>
    <div>
        <form @submit.prevent="submitForm">
            <div>
                <InputLabel for="first_name" value="First Name" />
                <TextInput
                    id="first_name"
                    v-model="form.first_name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="first_name"
                />
                <InputError class="mt-2" :message="form.errors.first_name" />
            </div>

            <div class="mt-4">
                <InputLabel for="last_name" value="Last Name" />
                <TextInput
                    id="last_name"
                    v-model="form.last_name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="last_name"
                />
                <InputError class="mt-2" :message="form.errors.last_name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="role" value="Role" />
                <div class="mt-2 flex items-center">
                    <label class="mr-4">
                        <input
                            type="radio"
                            v-model="form.role"
                            value="mentor"
                            required
                        />
                        Mentor
                    </label>
                    <label>
                        <input
                            type="radio"
                            v-model="form.role"
                            value="mentee"
                            required
                        />
                        Mentee
                    </label>
                </div>
                <InputError class="mt-2" :message="form.errors.role" />
            </div>

            <div class="mt-4">
                <button
                    type="submit"
                    class="btn btn-primary rounded-lg bg-primary py-2 px-4 text-white hover:bg-blue-600"
                >
                    Add User
                </button>
            </div>
        </form>
    </div>
</template>
