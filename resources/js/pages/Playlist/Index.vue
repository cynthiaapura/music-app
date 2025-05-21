<template>

  <Head title="Playlists" />

  <MusicLayout>
    <template #title>
      Playlists
    </template>

    <template #action>
      <Link :href="route('playlists.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded w-full mb-">
      Ajouter une playlist
      </Link>
    </template>

    <template #content>
      <div class="grid grid-cols-4 gap-4">
        <ul>
          <li v-for="playlist in playlists" :key="playlist.uuid">

          </li>
        </ul>  
      </div>
    </template>
  </MusicLayout>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import MusicLayout from '@/layouts/MusicLayout.vue';

export default {
  name: 'Index',
  components: {
    Head,
    MusicLayout,
    Track,
    Link,
  },
  props: {
    tracks: Array,
  }
}
</script>