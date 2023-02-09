<template>

    <div>
        <select-fieldtype :config="selectConfig" :value="selectedValue" @input="$emit('input', $event)"></select-fieldtype>
    </div>

</template>

<script>
export default {

    mixins: [Fieldtype],

    computed: {
        selectConfig() {
            this.config.options = this.meta.options;
            return this.config;
        },
        selectedValue() {
            return this.value ?? this.config.default;
        }
    }
};
</script>
