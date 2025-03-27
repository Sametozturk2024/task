@extends("layouts.main ")
   @section("content")

       <style>
           .success .task-list { color: #00bb00;}
           .warning .task-list { color:#b38700;}
           .info .task-list { color:#0b7dfd;  }
           .success .task-list i ,
           .warning .task-list i ,
           .info .task-list  i{ color:#000;  }
       </style>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">


                <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="taskModalLabel">Görev Ekle/Düzenle</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="taskForm" method="POST">
                                @csrf
                                @method('POST')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name" class="block text-gray-700 font-bold mb-2">Görev Adı</label>
                                        <input type="text" name="name" id="taskName" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="block text-gray-700 font-bold mb-2">Açıklama</label>
                                        <textarea name="description" id="taskDescription" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                                    <button type="submit" class="btn btn-primary">Kaydet</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Görev Ekle

                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('tasks.store') }}" method="POST"  >

                            <div class="modal-body">


                                <div class="card-body">


                                        <div class="form-group">
                                            <label for="name" class="block text-gray-700 font-bold mb-2">Görev Adı</label>
                                            <br>
                                            <input type="text" name="name" id="name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description" class="block text-gray-700 font-bold mb-2">Açıklama</label>
                                            <br>
                                            <textarea name="description" id="description" class="form-control" required></textarea>
                                        </div>


                                    @csrf



                                </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                                <button type="submit" class="btn btn-primary">Kaydet</button>

                            </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title mb-0">Görev Yönetim Sistemi </p>
                                <div class=" text-right">

                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">

                                         Görev Ekle
                                    </button>
                                </div>


                                <div class="table-responsive">


                                    <table class="tab-content " width="100%">

                                        <tr>
                                                <td class="col-md-4"> <h4 class="text-xl font-bold mb-4">Aktif </h4> </td>
                                            <td class="col-md-4"> <h4 class="text-xl font-bold mb-4">Beklemede </h4> </td>
                                            <td class="col-md-4"> <h4 class="text-xl font-bold mb-4">Tamamlandı </h4> </td>
                                        </tr>
                                        <tr>
                                            <td>

                                                <!-- Kanban Board -->
                                                <div id="kanban-board" class="grid grid-cols-3 gap-4">
                                                    <!-- Active Column -->

                                                    <div class="info " id="active-column">

                                                        <div class="task-list" data-status="active">
                                                            @foreach($active_tasks as $task)
                                                                <div class="task-card bg-white p-4 mb-4 rounded shadow cursor-move"
                                                                     data-task-id="{{ $task->id }}">
                                                                    <h3 class="font-bold">{{ $task->name }}</h3>
                                                                    <p class="text-gray-600">{{ $task->description }}</p>

                                                                    <div class="flex space-x-2">
                                                                        <a href="#" class="edit-task text-blue-500" data-task-id="{{ $task->id }}">
                                                                            <img src="{{ asset('backend/images/edit.svg') }}" width="15">
                                                                        </a>
                                                                        <a href="#" class="delete-task text-red-500" data-task-id="{{ $task->id }}">
                                                                            <i class="icon-trash"></i>
                                                                        </a>
                                                                    </div>


                                                                </div>




                                                            @endforeach
                                                        </div>
                                                    </div>

                                            </td>

                                            <td>
                                                <!-- Pending Column -->

                                                <div class="warning" id="pending-column">

                                                    <div class="task-list" data-status="pending">
                                                        @foreach($pending_tasks as $task)
                                                            <div class="task-card bg-white p-4 mb-4 rounded shadow cursor-move"
                                                                 data-task-id="{{ $task->id }}">
                                                                <h3 class="font-bold">{{ $task->name }}</h3>
                                                                <p class="text-gray-600">{{ $task->description }}</p>

                                                                <div class="flex space-x-2">
                                                                    <a href="#" class="edit-task text-blue-500" data-task-id="{{ $task->id }}">
                                                                        <img src="{{ asset('backend/images/edit.svg') }}" width="15">
                                                                    </a>
                                                                    <a href="#" class="delete-task text-red-500" data-task-id="{{ $task->id }}">
                                                                        <i class="icon-trash"></i>
                                                                    </a>
                                                                </div>

                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>


                                            </td>

                                            <td>

                                                <!-- Completed Column -->
                                                <div class="success" id="completed-column">

                                                    <div class="task-list" data-status="completed">
                                                        @foreach($completed_tasks as $task)
                                                            <div class="task-card bg-white p-4 mb-4 rounded shadow cursor-move"
                                                                 data-task-id="{{ $task->id }}">
                                                                <h3 class="font-bold">{{ $task->name }}</h3>
                                                                <p class="text-gray-600">{{ $task->description }}</p>

                                                                <div class="flex space-x-2">
                                                                    <a href="#" class="edit-task text-blue-500" data-task-id="{{ $task->id }}">
                                                                        <img src="{{ asset('backend/images/edit.svg') }}" width="15">
                                                                    </a>
                                                                    <a href="#" class="delete-task text-red-500" data-task-id="{{ $task->id }}">
                                                                        <i class="icon-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                            </td>

                                        </tr>


                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>


            <div class="container mx-auto p-6">


                <!-- Task Creation Form -->





                </div>
            </div>


       @push('scripts')
           <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
           <script>
               document.addEventListener('DOMContentLoaded', function() {
                   const columns = document.querySelectorAll('.task-list');

                   // Drag and Drop
                   columns.forEach(column => {
                       new Sortable(column, {
                           group: 'shared',
                           animation: 150,
                           onEnd: function (evt) {
                               const taskId = evt.item.getAttribute('data-task-id');
                               const newStatus = evt.to.getAttribute('data-status');

                               fetch('{{ route("tasks.update-status") }}', {
                                   method: 'POST',
                                   headers: {
                                       'Content-Type': 'application/json',
                                       'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                   },
                                   body: JSON.stringify({
                                       task_id: taskId,
                                       status: newStatus
                                   })
                               })
                                   .then(response => response.json())
                                   .catch(error => {
                                       console.error('Error:', error);
                                   });
                           }
                       });
                   });

                   // Edit Task
                   document.querySelectorAll('.edit-task').forEach(button => {
                       button.addEventListener('click', function(e) {
                           e.preventDefault();
                           const taskId = this.getAttribute('data-task-id');

                           fetch(`/tasks/${taskId}/edit`, {
                               method: 'GET',
                               headers: {
                                   'X-CSRF-TOKEN': '{{ csrf_token() }}'
                               }
                           })
                               .then(response => response.json())
                               .then(task => {
                                   // Prepare modal for editing
                                   const modal = $('#taskModal');
                                   const form = document.getElementById('taskForm');

                                   // Set form method to PUT for update
                                   form.setAttribute('action', `/tasks/${taskId}`);
                                   form.querySelector('input[name="_method"]').value = 'PUT';

                                   // Populate form fields
                                   document.getElementById('taskName').value = task.name;
                                   document.getElementById('taskDescription').value = task.description;

                                   // Show modal
                                   modal.modal('show');
                               })
                               .catch(error => {
                                   console.error('Error:', error);
                                   alert('Failed to load task details');
                               });
                       });
                   });

                   // Delete Task
                   document.querySelectorAll('.delete-task').forEach(button => {
                       button.addEventListener('click', function(e) {
                           e.preventDefault();
                           const taskId = this.getAttribute('data-task-id');

                           if (confirm('Bu görevi silmek istediğinizden emin misiniz?')) {
                               fetch(`/tasks/${taskId}`, {
                                   method: 'DELETE',
                                   headers: {
                                       'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                   }
                               })
                                   .then(response => response.json())
                                   .then(result => {
                                       if (result.success) {
                                           // Remove task from DOM
                                           const taskCard = document.querySelector(`.task-card[data-task-id="${taskId}"]`);
                                           if (taskCard) {
                                               taskCard.remove();
                                           }
                                       }
                                   })
                                   .catch(error => {
                                       console.error('Error:', error);
                                       alert('Görevi silme işlemi başarısız oldu');
                                   });
                           }
                       });
                   });

                   // Handle form submission for both create and update
                   $('#taskForm').on('submit', function(e) {
                       e.preventDefault();
                       const form = $(this);
                       const url = form.attr('action');
                       const method = form.find('input[name="_method"]').val() || 'POST';

                       $.ajax({
                           type: method,
                           url: url,
                           data: form.serialize(),
                           success: function(response) {
                               // Close modal
                               $('#taskModal').modal('hide');

                               // Reload the page to refresh the task list
                               location.reload();
                           },
                           error: function(xhr) {
                               // Handle validation errors
                               alert('Kaydetme işlemi başarısız oldu');
                               console.error(xhr.responseText);
                           }
                       });
                   });
               });
           </script>
       @endpush


   @endsection
