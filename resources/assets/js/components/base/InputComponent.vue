<template>
    <div>
        <div class="form-group">
            <label class="col-md-3 control-label" for="name">{{placeholder}}</label>
            <div class="col-md-9" :class="{'has-error': errors.has(name)}">
                <input :id="name"
                       :name="name"
                       v-validate.initial="rules"
                       v-model:value="internalValue"
                       :type="type"
                       class="form-control">
                <span v-show="errors.has(name)" class="help-block text-danger">{{ errors.first(name) }}</span>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: {
            value: {
                default: ''
            },
            name: {
                default: ''
            },
            rules: {
                default: ''
            },
            placeholder: {
                default: ''
            },
            type: {
                default: 'text'
            }
        },
        created: function() {
            this.internalValue = this.value;
        },
        data: function() {
            return {
                internalValue: '',
            }
        },
        watch: {
            'internalValue': function() {
                this.$emit('input', this.internalValue);
            }
        },
    }
</script>