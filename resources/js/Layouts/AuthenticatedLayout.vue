<script setup lang="ts">
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import MyFooter from '@/Components/MyFooter.vue';
import { Link } from '@inertiajs/vue3';
import MyNavbar from '@/Components/MyNavbar.vue';

const showingNavigationDropdown = ref(false);

import { useDark, useToggle } from '@vueuse/core'


const isDark = useDark()
const toggleDark = useToggle(isDark)
// On page load or when changing themes, best to add inline in `head` to avoid FOUC
if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
  document.documentElement.classList.add('dark')
} else {
  document.documentElement.classList.remove('dark')
}

// Whenever the user explicitly chooses light mode
localStorage.theme = 'light'

// Whenever the user explicitly chooses dark mode
localStorage.theme = 'dark'

// Whenever the user explicitly chooses to respect the OS preference
localStorage.removeItem('theme')

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
}>(); 

/* defineProps<{
    
}>(); */

import { computed } from 'vue';

import { usePage } from '@inertiajs/vue3'

const loggedIn = computed(() => {
   return !!usePage().props.auth.user
})
</script>

<template>
    <div>
        <!-- <MyNavbar /> -->
        <div class="min-h-screen">
            <nav class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700">
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

                    <div class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 ">
                        <button @click="toggleDark()" class="text-orange-300 dark:text-cyan-100">
                            <i :class="['fa-solid fa-2x', isDark ? 'fa-moon' : 'fa-sun', 'inline-block align-middle mr-2']"></i>
                            <span>{{ isDark ? 'Dark' : 'Light' }}</span>
                        </button>
                    </div>
    
                    <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                        <!-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" /> -->
                        <i class="fa-solid fa-meteor fa-2x fa-flip"></i>
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Hey Hey Yallzies...!</span>
                    </a>

                    <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-dropdown" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                        </svg>
                    </button>

                    <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
                    <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        <li>
                        <!-- <a href="#" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">Home</a> -->
                        <!-- <NavLink v-if="$page.props.auth.user" :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </NavLink> -->
                        </li>
                        <li v-if="canLogin || loggedIn">
                        <NavLink v-if="loggedIn" :href="route('dashboard')"  :active="route().current('dashboard')"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            Dashboard
                        </NavLink>

                        <template v-else>
                            <NavLink :href="route('login')"
                                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            Log in</NavLink>

                            <NavLink v-if="canRegister" :href="route('register')"
                                class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            Register</NavLink>
                        </template>
                        </li>
                        <li>
                        <!-- <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Services</a> -->
                        <NavLink v-if="$page.props.auth.user" :href="route('test')" :active="route().current('test')">
                            Test Page
                        </NavLink>
                        </li>
                        <li>
                        <!-- <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Pricing</a> -->
                        <NavLink :href="route('pinboard')" :active="route().current('pinboard')">
                            Pinboard
                        </NavLink>
                        </li>
                        <li v-if="$page.props.auth.user">
                                        <div  class="hidden sm:flex sm:items-cenhometer sm:ms-6">
                                            <div class="ms-3 relative">
                                                <Dropdown align="right" width="48">
                                                    <template #trigger>
                                                        <span class="inline-flex rounded-md">
                                                            <button
                                                                type="button"
                                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                                            >
                                                                {{ $page.props.auth.user.name }}

                                                                <svg
                                                                    class="ms-2 -me-0.5 h-4 w-4"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20"
                                                                    fill="currentColor"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                        clip-rule="evenodd"
                                                                    />
                                                                </svg>
                                                            </button>
                                                        </span>
                                                    </template>

                                                    <template #content>
                                                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                                            Log Out
                                                        </DropdownLink>
                                                    </template>
                                                </Dropdown>
                                            </div>
                                        </div>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>
            

            <!-- Page Heading -->
            <header class="bg-white dark:bg-black  shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="mb-8">
                <slot />
            </main>

            <MyFooter />
        </div>
    </div>
</template>