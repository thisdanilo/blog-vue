<template>
    <div class="modal fade" :class="{ 'show': show }" style="display: block; padding-right: 15px;" aria-modal="true"
        role="dialog" v-if="show">
        <div class="modal-dialog" :class="modalSize">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ title }}</h4>
                    <button type="button" class="close" @click="$emit('close')" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="$emit('close')">{{ cancelText }}</button>
                    <button type="button" :class="confirmButtonClass" @click="$emit('confirm')">{{ confirmText }}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: false
    },
    title: {
        type: String,
        default: 'Modal Title'
    },
    size: {
        type: String,
        default: 'md',
        validator: (value) => ['sm', 'md', 'lg'].includes(value)
    },
    cancelText: {
        type: String,
        default: 'Cancelar'
    },
    confirmText: {
        type: String,
        default: 'Confirmar'
    },
    confirmButtonClass: {
        type: String,
        default: 'btn btn-primary'
    }
});

const modalSize = computed(() => {
    return {
        'modal-sm': props.size === 'sm',
        'modal-lg': props.size === 'lg'
    };
});

defineEmits(['close', 'confirm']);
</script>

<style scoped>
.modal {
    background-color: rgba(0, 0, 0, 0.5);
}
</style>