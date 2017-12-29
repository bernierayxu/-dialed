<template>
    <div>
    	<div class="form-group">
            <label class="col-md-3 control-label" for="name">{{placeholder}}</label>
            <div class="col-md-9" :class="{'has-error': errors.has(name)}">
				<select v-model="internalValue" class="form-control" :name="name" v-validate="rules">
					<option disabled value="">Please select one</option>
					<option v-for="option in options" v-bind:value="option.id">
						{{ option[attr] }}
					</option>
				</select>
				<span v-show="errors.has(name)" class="help-block text-danger">{{ errors.first(name) }}</span>
			</div>
		</div>
    </div>
</template>

<script>

    export default {
        props: {
            options: {
                default: []
            },
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
            attr: {
            	default: 'code'
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