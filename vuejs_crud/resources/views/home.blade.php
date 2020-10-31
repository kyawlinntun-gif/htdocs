@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name" v-model="item.name">
                    </div>
                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input type="number" class="form-control" id="age" placeholder="Enter your age" v-model="item.age">
                    </div>
                    <div class="form-group">
                        <label for="profession">Profession:</label>
                        <input type="text" class="form-control" id="profession" placeholder="Enter your profession" v-model="item.profession">
                    </div>
                    <button type="submit" class="btn btn-primary" @click.prevent="itemsCreated">ADD</button>
                </form>
            </div>
            <div class="card-footer" v-show="errors">
                <div class="alert alert-danger">Please fill all the fields</div>
            </div>
        </div>
    </div>

    <div class="row mt-5" v-show="Object.keys(items.items).length > 0">
        <div class="col-6 offset-3">
            <table class="table table-dark">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Profession</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in items.items">
                    <th scope="row" v-text="item.id"></th>
                    <td v-text="item.name"></td>
                    <td v-text="item.age"></td>
                    <td v-text="item.profession"></td>
                    <td><i class="fas fa-edit btn text-primary" @click.prevent="showModal(item)"></i><i class="fas fa-trash btn text-danger" @click.prevent="deleteItem(item)"></i></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form @submit.prevent="editStore">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="hideModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name" v-model="editItems.items.name">
                        </div>
                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="number" class="form-control" id="age" placeholder="Enter your age" v-model="editItems.items.age">
                        </div>
                        <div class="form-group">
                            <label for="profession">Profession:</label>
                            <input type="text" class="form-control" id="profession" placeholder="Enter your profession" v-model="editItems.items.profession">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
