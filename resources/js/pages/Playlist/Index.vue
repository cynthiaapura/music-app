<template>
  <Head title="Playlists" />

  <MusicLayout>
    <template #title>
      Playlists
    </template>

    <template #action>
      <Link :href="route('playlists.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded w-full mb-4">
        Ajouter une playlist
      </Link>
    </template>

    <template #content>
      <div class="grid grid-cols-4 gap-4">
        <ul class="space-y-4">
          <li
            v-for="playlist in playlists"
            :key="playlist.uuid"
            class="p-4 border rounded shadow hover:shadow-md transition"
          >
            <div class="font-semibold text-lg mb-2">
              {{ playlist.title }} - {{ playlist.tracks_count }} musiques
            </div>

            <div class="flex flex-wrap gap-2">
              <!-- Bouton Voir -->
              <Link
                :href="route('playlists.show', { playlist: playlist })"
                class="bg-blue-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
              >
                Voir
              </Link>

              <!-- Boutons conditionnels -->
              <template v-if="isAdmin || user.id === playlist.user_id">
                <!-- Modifier -->
                <Link
                  :href="route('playlists.edit', { playlist: playlist })"
                  class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded"
                >
                  Modifier
                </Link>

                <!-- Supprimer -->
                <Link
                  :href="route('playlists.destroy', { playlist: playlist })"
                  method="delete"
                  as="button"
                  class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                >
                  Supprimer
                </Link>
              </template>
            </div>
          </li>
        </ul>
      </div>
    </template>
  </MusicLayout>
</template>

<script lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import MusicLayout from '@/layouts/MusicLayout.vue';

export default {
  name: 'Index',
  components: {
    Head,
    MusicLayout,
    Link,
  },
  props: {
    playlists: Array,
    auth: Object,
  },
  computed: {
    user() {
      return this.auth.user;
    },
    isAdmin() {
      return this.auth.isAdmin;
    }
  }
}
</script>
