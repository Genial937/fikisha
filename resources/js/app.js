import Vue from 'vue'

Vue.component('dashboard-component', require('./components/DashboardComponent.vue').default);
Vue.component('login-component', require('./components/auth/LoginComponent.vue').default)
Vue.component('register-component', require('./components/auth/RegisterComponent.vue').default);
Vue.component('products-component', require('./components/products/ProductsComponent.vue').default);
Vue.component('cart-component', require('./components/products/CartComponent.vue').default);
Vue.component('checkout-component', require('./components/products/CheckoutComponent.vue').default);
Vue.component('orders-component', require('./components/orders/OrdersComponent.vue').default);
Vue.component('vehicles-component', require('./components/vehicles/VehiclesComponent.vue').default);
Vue.component('customers-component', require('./components/customers/CustomersComponent.vue').default);
Vue.component('users-component', require('./components/users/UsersComponent.vue').default);
Vue.component('roles-component', require('./components/roles/RolesComponent.vue').default);
Vue.component('cart-count', require('./components/products/CartCountComponent.vue').default);

const app = new Vue({
    el: "#vue-app"
})
