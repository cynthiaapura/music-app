<template>
  <Head title="Clés API" />

  <MusicLayout>
    <template #title>Mes clés API</template>

    <template #action>
      <Link :href="route('api-keys.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
        Nouvelle clé API
      </Link>
    </template>

    <template #content>
      <table class="min-w-full table-auto border-collapse border border-gray-200">
        <thead>
          <tr>
            <th class="border border-gray-300 px-4 py-2">Nom</th>
            <th class="border border-gray-300 px-4 py-2">Clé</th>
            <th class="border border-gray-300 px-4 py-2">Créée le</th>
            <th class="border border-gray-300 px-4 py-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="key in keys" :key="key.id" class="hover:bg-gray-100">
            <td class="border border-gray-300 px-4 py-2">{{ key.name }}</td>
            <td class="border border-gray-300 px-4 py-2 font-mono break-all">{{ key.key }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ new Date(key.created_at).toLocaleDateString() }}</td>
            <td class="border border-gray-300 px-4 py-2">
              <Link
              :href="route('api-keys.destroy', key.id)"
              method="delete"
              as="button"
              class="text-red-600 hover:underline"
              @click.prevent="handleDelete(key)"
            >
              Supprimer
            </Link>
            </td>
          </tr>
          <tr v-if="keys.length === 0">
            <td colspan="4" class="text-center p-4 text-gray-500">Aucune clé API</td>
          </tr>
        </tbody>
      </table>
    </template>
  </MusicLayout>
</template>

<script lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import MusicLayout from '@/layouts/MusicLayout.vue';

export default {
  props: {
    keys: Array
  },
  components: { 
    Head, 
    Link, 
    MusicLayout 
  },
  methods: {
    handleDelete(key) {
    if (confirm(`Voulez-vous vraiment supprimer la clé "${key.name}" ?`)) {
      this.$inertia.delete(route('api-keys.destroy', key.id));
      }
    }
  }
}
</script>
