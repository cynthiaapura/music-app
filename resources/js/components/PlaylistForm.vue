<template>
  <form @submit.prevent="send">
    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Titre</label>

    <div class="flex items-center gap-4 mb-1">
      <input
        v-model="form.title"
        type="text"
        name="title"
        id="title"
        class="flex-grow shadow border rounded py-2 px-3 text-gray-700 appearance-none leading-tight focus:outline-none focus:shadow-outline"
        :class="{ 'border-red-500': form.errors.title }"
      />

      <input
        type="submit"
        :value="playlist ? 'Modifier la playlist' : 'Créer la playlist'"
        class="text-white font-bold rounded py-2 px-4 bg-blue-500 hover:bg-blue-700 cursor-pointer"
      />
    </div>

    <div v-if="form.errors.title" class="text-red-500 text-xs italic mb-4">
      {{ form.errors.title }}
    </div>

    <label for="tracks" class="block text-gray-700 text-sm font-bold mb-2">Musiques</label>
    <div class="grid grid-cols-2 gap-x-4 gap-y-2 mb-4">
      <div v-for="track in tracks" :key="track.uuid" class="flex items-center">
        <input v-model="form.tracks" type="checkbox" :value="track.uuid" :id="track.uuid" name="tracks" class="mr-2" />
        <label :for="track.uuid" class="select-none">{{ track.title }}</label>
      </div>
    </div>
  </form>
</template>


<script lang="ts">
export default {
  name: 'PlaylistTrack',
  props: {
    playlist: Object,
    tracks: Array,
  },
  data() {
    return {
      form: this.$inertia.form({
        title: this.playlist?.title ?? '',
        tracks: this.playlist ? this.playlist.tracks.map(track => track.uuid) : [],
      })
    }
  },
  methods: {
    send() {
      if (this.playlist) {
        this.form.put(route('playlists.update', { playlist: this.playlist }));
      } else {
        this.form.post(route('playlists.store'));
      }
    }
  }
}
</script>