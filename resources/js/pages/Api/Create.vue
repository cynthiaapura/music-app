<template>
  <Head title="Créer une clé API" />

  <MusicLayout>
    <template #title>Créer une clé API</template>

    <template #action>
      <Link :href="route('api-keys.index')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
        Retour à la liste
      </Link>
    </template>

    <template #content>
      <form @submit.prevent="send">
        <div class="mb-3">
          <label for="name" class="block mb-1 font-bold">Nom de la clé</label>
          <input v-model="form.name" type="text" id="name" class="border rounded px-3 py-2 w-full" :class="{ 'border-red-500': form.errors.name }" />
          <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          Créer la clé
        </button>
      </form>
    </template>
  </MusicLayout>
</template>

<script lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import MusicLayout from '@/layouts/MusicLayout.vue';

export default {
  components: { 
    Head, 
    Link, 
    MusicLayout 
  },
  data() {
    return {
      form: this.$inertia.form({
        name: ''
      })
    };
  },
  methods: {
    send() {
      this.form.post(route('api-keys.store'));
    }
  }
}
</script>
