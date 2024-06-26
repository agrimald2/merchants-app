<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import { ref } from 'vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    username: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const passwordFieldType = ref('password');
const togglePasswordVisibility = () => {
    passwordFieldType.value = passwordFieldType.value === 'password' ? 'text' : 'password';
};
</script>

<template>

    <Head title="Log in" />
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100">
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
            <div class="flex justify-center mb-6">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Arca_Continental_logo.svg/800px-Arca_Continental_logo.svg.png" alt="Arca Continental" class="w-32 h-auto" />
            </div>
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700">Usuario</label>
                    <input id="username" type="text" v-model="form.username"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Ingresa tu usuario" required />
                </div>
                <div class="mb-4 relative">
                    <label for="password" class="block text-gray-700">Contraseña</label>
                    <input :type="passwordFieldType" id="password" v-model="form.password"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Enter your password" required />
                    <button type="button" @click="togglePasswordVisibility"
                        class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 focus:outline-none top-6">
                        <i v-if="passwordFieldType === 'password'" class="fa-solid fa-eye"></i>
                        <i v-else class="fa-solid fa-eye-slash"></i>
                    </button>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="w-full bg-red-600 text-white font-bold py-2 px-4 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Ingresar
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
