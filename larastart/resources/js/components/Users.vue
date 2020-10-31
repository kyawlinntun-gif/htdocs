<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click.prevent="newModal">Add New <i class="fas fa-user-plus"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" v-show="data.length > 0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Registered At</th>
                                    <th>Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in data">
                                    <td>{{ user.id }}</td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ user.type | capitalize }}</td>
                                    <td>{{ user.created_at |humanDate }}</td>
                                    <td>
                                        <i class="fas fa-edit blue" style="cursor: pointer;" @click.prevent="editModal(user)"></i>
                                        /
                                        <i class="fas fa-trash red" style="cursor: pointer;" @click.prevent="deleteUser(user.id)"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="add_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form @submit.prevent=" editmode ? updateUser() : createUser()" @keydown="form.onKeydown($event)">
                        <div class="modal-header">
                            <h5 class="modal-title" v-show="!editmode" id="exampleModalLabel">Add New</h5>
                            <h5 class="modal-title" v-show="editmode" id="exampleModalLabel">Update User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input v-model="form.name" type="text" name="name" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input v-model="form.email" type="email" name="email" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input v-model="form.password" type="password" name="password" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <select name="type" v-model="form.type" class="form-control" :class="{ 'is-invalid' : form.errors.has('type') }">
                                    <option value="">Select Type</option>
                                    <option value="admin">Admin</option>
                                    <option value="author">Author</option>
                                    <option value="user">Standard User</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Bio</label>
                                <textarea name="bio" id="bio" class="form-control" :class="{ 'is-invalid' : form.errors.has('bio')}" v-model="form.bio" cols="30" rows="5"></textarea>
                                <has-error :form="form" field="bio"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Photo</label>
                                <input v-model="form.photo" type="text" name="photo" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('photo') }">
                                <has-error :form="form" field="photo"></has-error>
                            </div>
                            <!-- <button :disabled="form.busy" type="submit" class="btn btn-primary">Create</button> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" :disabled="form.busy" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" :disabled="form.busy" v-show="!editmode" class="btn btn-primary">Create</button>
                            <button type="submit" :disabled="form.busy" v-show="editmode" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data () {
            return {
                // Edit mode
                editmode: false,
                // Create a new form instance
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo: ''
                }),
                data: {},
            }
        },
        methods: {
            updateUser()
            {
                // console.log('Update user');

                // Progress start
                this.$Progress.start();

                this.form.put('/api/user/'+this.form.id)
                .then( response => {
                    Toast.fire({
                        icon: 'success',
                        title: 'User was updated in successfully'
                    });
                    $('#add_user').modal('hide');
                    Fire.$emit('AfterUpdated');
                    this.$Progress.finish();
                })
                .catch( errors => {
                    Toast.fire({
                        icon: 'error',
                        title: 'User was not updated in successfully'
                    });
                    this.$Progress.fail();
                });
            },
            editModal(user)
            {
                this.editmode = true;
                this.form.reset();
                $('#add_user').modal('show');
                this.form.fill(user);
                // console.log(user);
            },
            newModal()
            {
                this.editmode = false;
                this.form.reset();
                $('#add_user').modal('show');
            },
            deleteUser(id)
            {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        // Progress start
                        this.$Progress.start();

                        // Delete request
                        this.form.delete('/api/user/'+id)
                        .then( response => {
                            Fire.$emit('AfterDeleted');

                            Swal.fire(
                                'Deleted!',
                                "User's data has been deleted.",
                                'success'
                            )

                            this.$Progress.finish();
                        })
                        .catch( errors => {
                            Swal.fire(
                                'Not Deleted!',
                                "User's data has not been deleted.",
                                'error'
                            )

                            this.$Progress.fail();
                        });

                    }
                })
            },
            createUser()
            {
                // Progress start
                this.$Progress.start();

                this.form.post('/api/user')
                .then( response => {
                    Toast.fire({
                        icon: 'success',
                        title: 'User was created in successfully'
                    });
                    $('#add_user').modal('hide');
                    Fire.$emit('AfterCreated');
                    this.$Progress.finish();
                })
                .catch( errors => {
                    Toast.fire({
                        icon: 'error',
                        title: 'User was not created in successfully'
                    });
                    this.$Progress.fail();
                });
            },
            getUsers()
            {
                this.form.get('/api/user')
                .then( response => this.data = response.data.users);
            }
        },
        created() {
            this.getUsers();
            // setInterval(() => this.getUsers(), 3000);
            Fire.$on('AfterCreated', () => {
                this.getUsers();
            });
            Fire.$on('AfterDeleted', () => {
                this.getUsers();
            });
            Fire.$on('AfterUpdated', () => {
                this.getUsers();
            });
        }
    }
</script>
