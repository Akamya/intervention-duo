<script setup>
import { defineProps } from "@vue/runtime-core";
import { useForm } from "@inertiajs/vue3";

const props = defineProps(["client"]);
// console.log(props);

const form = useForm({
    id: props.client.id,
    nom: props.client.nom, // Utiliser les valeurs du client ou une chaîne vide par défaut
    prenom: props.client.prenom,
    email: props.client.email,
    telephone: props.client.telephone,
});
</script>

<template>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6 text-gray-700">
                    Modifier les informations d'un client
                </h2>

                <!-- Formulaire -->
                <form
                    @submit.prevent="
                        form.put(route('clients.update', props.client.id))
                    "
                    enctype="multipart/form-data"
                    class="space-y-6"
                >
                    <!-- Nom -->
                    <div>
                        <label
                            for="nom"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Nom
                        </label>
                        <input
                            type="text"
                            id="nom"
                            v-model="form.nom"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        />
                        <div
                            v-if="form.errors.nom"
                            class="text-sm text-red-500 mt-1"
                        >
                            {{ form.errors.nom }}
                        </div>
                    </div>

                    <!-- Prenom -->
                    <div>
                        <label
                            for="prenom"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Prénom
                        </label>
                        <input
                            type="text"
                            id="prenom"
                            v-model="form.prenom"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        />
                        <div
                            v-if="form.errors.prenom"
                            class="text-sm text-red-500 mt-1"
                        >
                            {{ form.errors.prenom }}
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label
                            for="email"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Email
                        </label>
                        <input
                            type="email"
                            id="email"
                            v-model="form.email"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        />
                        <div
                            v-if="form.errors.email"
                            class="text-sm text-red-500 mt-1"
                        >
                            {{ form.errors.email }}
                        </div>
                    </div>

                    <!-- Téléphone -->
                    <div>
                        <label
                            for="telephone"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Téléphone
                        </label>
                        <input
                            type="tel"
                            id="telephone"
                            v-model="form.telephone"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        />
                        <div
                            v-if="form.errors.telephone"
                            class="text-sm text-red-500 mt-1"
                        >
                            {{ form.errors.telephone }}
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
</template>
