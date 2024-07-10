<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    dni: '',
});

const submit = () => {
    form.post(route('merchant.login.dni'), {
        onFinish: () => form.reset('dni'),
    });
};

</script>

<template>

    <Head title="Log in" />
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100">
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
            <div class="flex justify-center mb-6">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Arca_Continental_logo.svg/800px-Arca_Continental_logo.svg.png"
                    alt="Arca Continental" class="w-32 h-auto" />
            </div>
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label for="dni" class="block text-gray-700">DNI</label>
                    <input id="dni" type="text" v-model="form.dni"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Ingresa tu DNI" required />
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
