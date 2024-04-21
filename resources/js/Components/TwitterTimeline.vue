<script lang="ts">
import { defineComponent, onMounted } from 'vue';

// Extend Window interface to include twttr
declare global {
  interface Window {
    twttr?: any;
  }
}

export default defineComponent({
  name: 'TwitterTimeline',
  setup() {
    onMounted(() => {
      // Load Twitter widgets
      if (typeof window !== 'undefined' && window.twttr) {
        window.twttr.widgets.load();
      }
    });

    return {};
  },
});
  </script>

<template>
    <div class="card p-4 bg-pink-500">
      <a class="twitter-timeline" data-width="500" data-theme="dark" href="https://twitter.com/Krakatoom1?ref_src=twsrc%5Etfw">Tweets by Krakatoom1</a>
    </div>
  </template>
  

  