@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Documentation</h4>
                    <div class="">
                        <ul class="verti-timeline list-unstyled">
                            <li class="event-list">
                                <div class="event-date text-primar">Dashboard</div>
                                <h5>Holds Statistics in brief</h5>
                                <p class="text-muted">Here is where logged in user can see all statistics at glance</p>
                            </li>
                            <li class="event-list">
                                <div class="event-date text-primar">Products</div>
                                <h5>Hols products</h5>
                                <p class="text-muted">Here is where user or customer can make an order by adding items
                                    to cart and checking out. Add product button is only visible to admin</p>
                            </li>
                            <li class="event-list">
                                <div class="event-date text-primar">Orders</div>
                                <h5>Orders list and status</h5>
                                <p class="text-muted">This module holds information about all orders and their status,
                                    it also gives room to assign vehicles to orders as well as changing order status</p>
                            </li>
                            <li class="event-list">
                                <div class="event-date text-primar">Customers</div>
                                <h5>Customer data</h5>
                                <p class="text-muted">This module shows data of all customers together with their order
                                    details in terms of no of orders made</p>
                            </li>
                            <li class="event-list">
                                <div class="event-date text-primar">Users</div>
                                <h5>System users</h5>
                                <p class="text-muted">Show data of designated system users presicely system admins who
                                    are in charge of handling shop and orders</p>
                            </li>
                            <li class="event-list">
                                <div class="event-date text-primar">Roles</div>
                                <h5>User roles</h5>
                                <p class="text-muted">This module handles user roles, we have admin and customer,
                                    Customer is assigned role immediately they checkout</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
