<script setup lang="ts">
import MyFooter from '@/Components/MyFooter.vue';
import MyNavbar from '@/Components/MyNavbar.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { defineProps } from 'vue';

import { useDark, useToggle } from '@vueuse/core'

const showingNavigationDropdown = ref(false);

/* const isDark = useDark()
const toggleDark = useToggle(isDark)
// On page load or when changing themes, best to add inline in `head` to avoid FOUC
if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
  document.documentElement.classList.add('dark')
} else {
  document.documentElement.classList.remove('dark')
} */

// Whenever the user explicitly chooses light mode
localStorage.theme = 'light'

// Whenever the user explicitly chooses dark mode
localStorage.theme = 'dark'

// Whenever the user explicitly chooses to respect the OS preference
localStorage.removeItem('theme')

const props = defineProps<{
    message?: {
        id: number;
        user_id: number;
        title: string;
        leadtext: string;
        message: string;
        image: string | null;
    };
    authId?: number;
}>();
</script>

<template>
    <MyNavbar />
        <div class="min-h-screen">
  

                <header class="bg-white shadow" v-if="$slots.header">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <slot name="header" />
                    </div>
                </header>

                <main class="mb-8">
                    <slot />
                </main>
                
                <MyFooter class="relative bottom-[-20rem]" />
            </div>
   
</template>
