<template>
	<div class="alert alert-danger" v-if="error">
		{{ error }}
	</div>
	<div class="alert alert-success" v-if="success_message">
		{{ success_message }}
	</div>
	<form @submit.prevent="feedbackFormSubmit">
		<div class="mb-3">
			<label for="name" class="form-label">Name:</label>
			<input type="name" class="form-control" id="name" v-model="name">
			<ul class="form-text text-danger" v-if="validation_messages['name']">
				<li v-for="validation_message in validation_messages['name']">
					{{ validation_message }}
				</li>
			</ul>
		</div>
		<div class="mb-3">
			<label for="phone" class="form-label">Phone:</label>
			<input type="phone" class="form-control" id="phone" v-model="phone">
			<ul class="form-text text-danger" v-if="validation_messages['phone']">
				<li v-for="validation_message in validation_messages['phone']">
					{{ validation_message }}
				</li>
			</ul>
		</div>
		<div class="mb-3">
			<label for="message" class="form-label">Message:</label>
			<textarea class="form-control" id="message" rows="5" v-model="message"></textarea>
			<ul class="form-text text-danger" v-if="validation_messages['message']">
				<li v-for="validation_message in validation_messages['message']">
					{{ validation_message }}
				</li>
			</ul>
		</div>
		<div class="d-grid gap-2">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</form>
</template>

<script>
export default {
	data() {
		return {
			name: '',
			phone: '',
			message: '',
			validation_messages: [],
			success_message: '',
			error: ''
		}
	},
	methods: {
		feedbackFormSubmit() {
			let feedbackForm = this;

			feedbackForm.clearValidation();
			feedbackForm.clearSuccess();
			feedbackForm.clearError();

			axios.post('/', {
				name: this.name,
				phone: this.phone,
				message: this.message
			})
			.then(function (response) {
				if (!response.data.success) {
					if (response.data.why == 'validation_failed') {
						feedbackForm.validation_messages = response.data.validation_messages;  
						return;
					} else {
						feedbackForm.error = response.data.error;  
						return;
					}
				}
				
				feedbackForm.success_message = response.data.success_message;
				feedbackForm.clearData();
				return;
			})
			.catch(function (error) {  
				feedbackForm.error = error;
			});  
		},
		clearData() {
			this.name = '';
			this.phone = '';
			this.message = '';
		},
		clearValidation() {
			this.validation_messages = [];
		},
		clearSuccess() {
			this.success_message = '';
		},
		clearError() {
			this.error = '';
		}
	}
}
</script>