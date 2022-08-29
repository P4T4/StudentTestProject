<script setup>
import BreezeButton from "@/Components/Button.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    isLoggedIn: Boolean,
});

const redirect = (nameRoute) => {
    location.href = route(nameRoute);
};
</script>

<template>
    <Head title="Welcome" />
    <div
        v-if="canLogin"
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"
    >
        <div
            v-if="!$page.props.auth.user"
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <div>
                <BreezeButton class="ml-4" @click="redirect('login')">
                    Log in
                </BreezeButton>
            </div>
            <div>
                <BreezeButton class="ml-4" @click="redirect('register')">
                    Register
                </BreezeButton>
            </div>
        </div>
        <template v-else>
            <div
                class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
            >
                <h1>
                    Estas logueado, por favor redirigete al dashboard
                </h1>
                <div class="flex items-center justify-end mt-4">
                    <BreezeButton class="ml-4" @click="redirect('dashboard')">
                        Ir al Dashboard
                    </BreezeButton>
                </div>
            </div>
        </template>
    </div>
</template>
