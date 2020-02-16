
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
	data: {
		// для понимания того, какое row редактировать
		currentFieldId: 0,
		editCurrentField: false,
		// для Post запросов
		request: {
			fieldId: 0,	
			orderId: 0,	
			country: '',
			city: '',
			street: '',
			house: '',
			room: '',
		},	
		json_data: []
	},
	methods: {
		// клик по кнопке Изменить
		clickEditButton: function(fieldId) {
			this.currentFieldId = fieldId;
			this.editCurrentField = true;	
		},
		// клик по кнопке Сохранить
		clickSaveButton: function(fieldId) {
			this.currentFieldId = fieldId;
			this.editCurrentField = false;

			// закидываем значения со страницы в объект для post запросов
			this.request.fieldId = fieldId;
			this.request.orderId = this.$refs['refOrderId_'+fieldId+''].value;;
			this.request.country = this.$refs['refCountry_'+fieldId+''].value;
			this.request.city = this.$refs['refCity_'+fieldId+''].value;
			this.request.street = this.$refs['refStreet_'+fieldId+''].value;
			this.request.house = this.$refs['refHouse_'+fieldId+''].value;
			this.request.room = this.$refs['refRoom_'+fieldId+''].value;
			
			// посылаем пост запрос
			axios.post('/order-edit', {
			    data: this.request,
			    // выводим на странице сообщение с ответа
			}).then(response => (this.$refs.refMessageFromRequest.innerText = response.data[0].message));			
		},
	}
});
