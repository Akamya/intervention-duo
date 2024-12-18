<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps(["id"]);
const form = useForm({
    title: "",
    comment: "",
    img_path: "",
    // admin: "",
});
function sendform() {
    form.post(route("interventions.store", props.id));
}
function handlefilechange(event) {
    form.img_path = event.target.files;
}
</script>

<template>
    <AppLayout title="Create intervention">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Créer Intervention
                </h2>
            </div>
        </template>

        <form @submit.prevent="sendform">
            <div class="flex flex-col">
                <!-- nom -->
                <input type="text" v-model="form.title" placeholder="title" />
                <div v-if="form.errors.title">{{ form.errors.title }}</div>

                <input
                    type="text"
                    v-model="form.comment"
                    placeholder="comment"
                />
                <div v-if="form.errors.comment">{{ form.errors.comment }}</div>

                <div class="p-6">
                    <h1 class="text-xl font-bold mb-4">Uploader une image</h1>

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
                    <div v-if="previewUrl" class="mt-4">
                        <h2 class="text-lg font-medium mb-2">Aperçu :</h2>
                        <img
                            alt="Aperçu de l'image"
                            class="w-64 h-64 object-cover border"
                        />
                    </div>
                </div>
                <!-- Submit -->
                <button type="submit" :disabled="form.processing">Creer</button>
            </div>
        </form>
    </AppLayout>
</template>
