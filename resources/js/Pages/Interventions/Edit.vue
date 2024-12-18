<script setup>
import { defineProps } from "@vue/runtime-core";
import { useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps(["intervention"]);
// console.log(props);

const form = useForm({
    id: props.intervention.id,
    title: props.intervention.title,
    comment: props.intervention.comment,
    img_path: "",
});
function handlefilechange(event) {
    form.img_path = event.target.files;
}
function sendform() {
    form.post(route("interventions.rajout_images", form.id));
}
let selected_image_id = 0;
function deleteImage(selected_image_id) {
    form.delete(route("interventions.delete.image", selected_image_id));
}
</script>

<template>
    <AppLayout title="Mofidier">
        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6"
                >
                    <h2 class="text-2xl font-bold mb-6 text-gray-700">
                        Modifier les informations de l'interventions
                    </h2>

                    <!-- Formulaire -->
                    <form
                        @submit.prevent="
                            form.put(
                                route('interventions.update', intervention)
                            )
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
                                comment
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

                    <form @submit.prevent="sendform">
                        <div
                            class="flex flex-col m-4 border-4 border-t-red-500"
                        >
                            <div class="p-6">
                                <h1 class="text-xl font-bold mb-4">
                                    Uploader une image
                                </h1>

                                <!-- Input pour choisir une image -->
                                <input
                                    type="file"
                                    multiple
                                    id="img_path"
                                    name="img_path"
                                    @change="handlefilechange"
                                />
                                <div v-if="form.errors.img_path">
                                    {{ form.errors.img_path }}
                                </div>

                                <!-- Prévisualisation de l'image -->
                            </div>
                            <!-- Submit -->

                            <button
                                class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition w-56"
                                type="submit"
                                :disabled="form.processing"
                            >
                                Creer
                            </button>
                        </div>
                    </form>

                    <h1
                        class="font-bold , text-red-600 text-xl m-5 py-9 border-4 border-t-red-500"
                    >
                        Delete Images en cliquant dessus
                    </h1>

                    <!-- Itération sur les images -->
                    <div
                        v-for="image in intervention.images"
                        :key="image.id"
                        class="mb-4"
                    >
                        <!-- Bouton pour chaque image -->
                        <button
                            type="submit"
                            class="px-4 py-2 text-gray-800 flex items-center space-x-2"
                            @click="deleteImage(image.id)"
                        >
                            <img
                                :src="`/storage/${image.img_path}`"
                                :alt="`Image ${image.id}`"
                                class="w-96 object-cover border"
                            />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
