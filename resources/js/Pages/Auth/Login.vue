<script setup lang="ts">
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';



defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<template>
    <GuestLayout>
        <template #header class="animationcontainer">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center moving-text">
          Log In ...............................................................................................
        </h2>
      </template>
        <Head title="Log in"></Head>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <div class="flex justify-center relative sm:align-middle mt-12 md:top-48">
            <div class="sm:w-1/1 md:w-1/4">
                <form @submit.prevent="submit" class="">
                    <div class="">
                        <InputLabel class="text-zinc-800 dark:text-zinc-100" for="email" value="Email" />

                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full text-zinc-100 dark:text-zinc-800 bg-zinc-800 dark:bg-zinc-100"
                            v-model="form.email"
                            required
                            autofocus
                            autocomplete="username"
                        />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel class="text-zinc-800 dark:text-zinc-100" for="password" value="Password" />

                        <TextInput
                            id="password"
                            type="password"
                            class="mt-1 block w-full text-zinc-100 dark:text-zinc-800 bg-zinc-800 dark:bg-zinc-100"
                            v-model="form.password"
                            required
                            autocomplete="current-password"
                        />

                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center ">
                            <Checkbox class="dark:text-zinc-800 bg-zinc-800 dark:bg-zinc-100" name="remember" v-model:checked="form.remember" />
                            <span class="ms-2 text-sm ext-zinc-800 dark:text-zinc-100">Remember me</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-500"
                        >
                            Forgot your password?
                        </Link>

                        <PrimaryButton class="ms-4 dark:text-zinc-800 bg-zinc-800 dark:bg-zinc-100" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Log in
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
        
        
    </GuestLayout>
</template>

<style>
.animation-container {
  overflow: hidden;
}

.moving-text {
  white-space: nowrap;
  position: relative;
  animation: moveText 10s linear infinite;
}

@keyframes moveText {
  0% {
    right: -100%; /* Start off screen */
  }
  100% {
    right: 100%; /* Move to the right until it's off screen */
  }
}</style>

