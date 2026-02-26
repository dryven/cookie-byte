<script setup>
import { PublishContainer, Header, Button } from '@statamic/cms/ui';
import { Pipeline, Request } from '@statamic/cms/save-pipeline';
import { ref, useTemplateRef, onMounted, onUnmounted } from 'vue';
import { Head, router } from '@statamic/cms/inertia';


const props = defineProps({
    initialValues: Object,
    initialBlueprint: Object,
    initialMeta: Object,
    action: String,
    title: String,
})

const container = useTemplateRef('container');
const values = ref(props.initialValues)
const meta = ref(props.initialMeta)
const saving = ref(false);
const errors = ref({}); 
const blueprint = ref(props.initialBlueprint);

function save() {
    new Pipeline()
        .provide({ container, errors, saving })
        .through([
            new Request(props.action, 'post'),
        ])
        .then((response) => {
            Statamic.$toast.success(__('Saved'));
            router.get(response.data.redirect);
        })
        .catch((e) => {
            if (!(e instanceof PipelineStopped)) {
				Statamic.$toast.error(__('Something went wrong'));
                console.error(e);
			}
        });
}

let saveKeyBinding;

onMounted(() => {
    saveKeyBinding = Statamic.$keys.bindGlobal(['mod+s'], (e) => {
        e.preventDefault();
        save();
    });
});

onUnmounted(() => saveKeyBinding.destroy());
</script>

<template>
    <Head :title />
    <div>
        <Header :title="title">
            <Button text="Save" variant="primary" :disabled="saving" @click="save" />
        </Header>

        <PublishContainer
            ref="container"
            name="cookie-byte-settings"
            :blueprint="blueprint"
            v-model="values"
            :meta="meta"
            :errors="errors"
        />
    </div>
</template>