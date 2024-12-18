<script setup>
import { defineProps } from "@vue/runtime-core";
import { useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps(["intervention"]);
// console.log(props);

const form = useForm({
    id: props.intervention.id,
    title: props.intervention.title,
    comment: props.intervention.comment, // Utiliser les valeurs du client ou une chaîne vide par défaut
    // image: props.client.comment,
});
</script>

<template>
    <AppLayout title="Mofidier">
        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6"
                >
                    <h2 class="text-2xl font-bold mb-6 text-gray-700">
                        Modifier les informations d'un client
                    </h2>

                    <!-- Formulaire -->
                    <form
                        @submit.prevent="
                            form.put(route('interventions.update', form))
                        "
                        enctype="multipart/form-data"
                        class="space-y-6"
                    >
                        <!-- title -->
                        <div>
                            <label
                                for="title"
                                class="block text-sm font-medium text-gray-700"
                            >
                                title
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
                                for="comment"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Prétitle
                            </label>
                            <input
                                type="text"
                                id="comment"
                                v-model="form.comment"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            />
                            <div
                                v-if="form.errors.comment"
                                class="text-sm text-red-500 mt-1"
                            >
                                {{ form.errors.comment }}
                            </div>
                        </div>

                        <!-- Bouton -->
                        <div class="mt-6 flex justify-end">
                            <button
                                type="submit"
                                class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition"
                            >
                                Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
