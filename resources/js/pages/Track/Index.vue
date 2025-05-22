<template>

  <Head title="Tracks" />

  <MusicLayout>
    <template #title>
      Listes des musiques
    </template>

    <template #action>
      <div class="flex gap-2">
        <Link v-if="$page.props.auth.isAdmin" :href="route('tracks.create')" 
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
          Ajouter une musique
        </Link>
        <Link v-if="$page.props.auth.user" :href="route('api-keys.index')" 
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
          Voir les clés API
        </Link>
      </div>
    </template>

    <template #content>
      <TrackList :tracks="tracks" />
    </template>
  </MusicLayout>
</template>

<script lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import MusicLayout from '@/layouts/MusicLayout.vue';
import TrackList from '@/components/TrackList.vue';

export default {
  name: 'Index',
  components: {
    Head,
    MusicLayout,
    Link,
    TrackList,
  },
  props: {
    tracks: Array,
  },
}
</script>