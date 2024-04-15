<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
    auth: Object;
    message: {
        id: number;
        user_id: number;
        title: string;
        leadtext: string;
        message: string;
        image: string | null;
    };
    authId: number;
    mustVerifyEmail?: boolean;
    status?: string
}>();
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout
        :can-login="props.canLogin"
        :can-register="props.canRegister"
        :laravel-version="props.laravelVersion"
        :php-version="props.phpVersion"
        :auth="props.auth"
        :message="props.message"
        :auth-id="props.authId"
    >
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateProfileInformationForm
                        :must-verify-email="props.mustVerifyEmail"
                        :status="props.status"
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
