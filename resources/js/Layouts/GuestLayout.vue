<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import MyFooter from '@/Components/MyFooter.vue';
import MyNavbar from '@/Components/MyNavbar.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

import { useDark, useToggle } from '@vueuse/core'

const showingNavigationDropdown = ref(false);

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

/* const messages = ref<Message[]>([]); */

const props = defineProps<{
    message: {
        id: number;
        user_id: number; // Add user_id to the message object
        title: string;
        leadtext: string;
        message: string;
        image: string | null;
    };
    authId: number; // Add authId prop
}>();
</script>

<template>
    <MyNavbar />
    <div class="min-h-screen">
        
        <!-- <div>
            
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>

            <Link href="/">
                home
            </Link>
        </div> -->

        <div>
            <slot />
        </div>
        
    </div>
    <MyFooter />
</template>
