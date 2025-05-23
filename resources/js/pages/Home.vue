<template>
  <MusicLayout>
    <template #title>
      Bienvenue sur l'application de musique la plus chill
    </template>

    <template #content>
      <div>
        <input v-model="firstname" type="text" name="firstname" id="firstname">
        <input v-model="lastname" type="text" name="lastname" id="lastname"><br>
        {{ fullName }}
      </div>
    </template>
  </MusicLayout>
</template>

<script lang="ts">
import MusicLayout from '@/layouts/MusicLayout.vue';

export default {
  name: 'Home',
  components: {
    MusicLayout,
  },

  computed: {
    fullName() {
      return this.firstname + ' ' + this.lastname;
    }
  }
}
</script>