<script setup>
import { ref } from 'vue';
import { Combobox } from '@statamic/cms/ui';
import { Fieldtype } from '@statamic/cms';

const emit = defineEmits(Fieldtype.emits);
const props = defineProps(Fieldtype.props);

const { expose, update } = Fieldtype.use(emit, props);
defineExpose(expose);

const options = ref(props.config.options ?? props.meta.options);
const multiple = ref(props.config.multiple ?? props.meta.multiple);

</script>

<template>
    <Combobox :options :multiple :modelValue="value" @update:modelValue="update"/>
</template>
