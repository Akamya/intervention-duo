<script setup>
import { defineProps } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    categories: Array, // Liste des catégories envoyée depuis Laravel
});

const form = useForm({
    commentaire: "",
    title: "",
    categorie: "",
});
</script>

<template>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6 text-gray-700">
                    Création d'un ticket
                </h2>

                <!-- Formulaire -->
                <form
                    @submit.prevent="form.post(route('tickets.create'))"
                    enctype="multipart/form-data"
                    class="space-y-6"
                >
                    <div>
                        <label
                            for="title"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Titre
                        </label>
                        <input
                            type="text"
                            id="title"
                            v-model="form.title"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        />
                        <div
                            v-if="form.errors.title"
                            class="text-sm text-red-500 mt-1"
                        >
                            {{ form.errors.title }}
                        </div>
                    </div>

                    <div>
                        <label
                            for="categorie"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Catégorie
                        </label>
                        <select
                            id="categorie"
                            v-model="form.categorie"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="" disabled>
                                Sélectionnez une catégorie
                            </option>
                            <option
                                v-for="categorie in categories"
                                :key="categorie.value"
                                :value="categorie.value"
                            >
                                {{ categorie.label }}
                            </option>
                        </select>
                        <div
                            v-if="form.errors.categorie"
                            class="text-sm text-red-500 mt-1"
                        >
                            {{ form.errors.categorie }}
                        </div>
                    </div>

                    <div>
                        <label
                            for="commentaire"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Commentaire
                        </label>
                        <input
                            type="text"
                            id="commentaire"
                            v-model="form.commentaire"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        />
                        <div
                            v-if="form.errors.commentaire"
                            class="text-sm text-red-500 mt-1"
                        >
                            {{ form.errors.commentaire }}
                        </div>
                    </div>

                    <!-- Bouton -->
                    <div class="mt-6 flex justify-end">
                        <button
                            type="submit"
                            class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition"
                        >
                            Créer le ticket
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
