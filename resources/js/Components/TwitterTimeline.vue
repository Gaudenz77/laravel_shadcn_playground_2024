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
    <div>
      <a class="twitter-timeline" data-width="400" data-height="600" href="https://twitter.com/Krakatoom1?ref_src=twsrc%5Etfw">Tweets by TwitterDev</a>
    </div>
  </template>
  

  