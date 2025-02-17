@extends('dashboard.dashboard')

@section('content')

    <!-- Local Bootstrap and DataTables CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">

    <style>
        .scrollable-table {
            overflow-y: auto;
            max-height: 400px;
        }

        .preview-section {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            min-height: 150px;
            max-height: 150px;
            overflow-y: auto;
            background: #f8f9fa;
            margin-bottom: 15px;
            font-size: 14px;
            margin-top: 20px; /* Added more margin-top to the preview section */
        }

        .preview-section p {
            color: black; /* Set email text color to pure black */
            font-size: 14px;
            padding: 5px;
        }

        .textarea-section {
            margin-top: 10px;
        }

        .btn-primary {
            margin-top: 10px;
            width: 100%;
        }

        /* Single card layout */
        .card-wrapper {
            max-width: 800px;
            margin: 0 auto;
        }

        .card {
            width: 100%;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .card-header {
            color: white;
            font-weight: bold;
            padding: 15px;
        }

        .card-body {
            padding: 15px;
        }

        /* Table Design */
        table.dataTable thead th {
            color: white;
        }

        .table thead th {
            text-align: left;
            padding: 10px;
        }

        .table tbody td {
            vertical-align: middle;
        }

        .form-control {
            border-radius: 4px;
        }

        .send-btn {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
            font-weight: bold;
        }

        .send-btn:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Adjust DataTable search */
        .dataTables_wrapper .dataTables_filter {
            float: right;
            text-align: right;
        }
    </style>

    <div class="container mt-5">
        <h3 class="text-center mb-4">Send Emails</h3>
        <div class="card-wrapper">
            <!-- User List Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">User List</h5>
                </div>
                <div class="card-body scrollable-table p-3">
                    <table id="example" class="table table-hover table-striped table-bordered" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col"><input type="checkbox" id="selectAll"></th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th> <!-- Changed from Status to Role -->
                            </tr>
                        </thead>
                        <tbody id="userTable">
                            @foreach ($users as $user)
                            <tr>
                                <td><input type="checkbox" class="user-checkbox" data-email="{{ $user->email }}"></td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ ucfirst($user->role) }}</td> <!-- Display the role in a readable format -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Preview and Send Emails Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Preview Selected Emails</h5>
                </div>
                <div class="card-body">
                    <div id="previewEmails" class="preview-section">
                        <p class="text-muted">No emails selected...</p>
                    </div>
                    <div class="textarea-section">
                        <label for="message">Message:</label>
                        <textarea id="message" class="form-control" rows="5" placeholder="Type your message here..."></textarea>
                    </div>
                    <button class="btn send-btn mt-3" id="sendEmails">Send Emails</button>
                </div>
            </div>
        </div>
    </div>
    @endsection


    <!-- Local JS Dependencies -->
@section('script')
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.emailjs.com/dist/email.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script type="text/javascript">
        (function(){
            emailjs.init({
                publicKey: "0dMRxNCWr5DsN1cPQ",
            });
        })();
    </script>

    <script>
        $(document).ready(function () {
            // Initialize DataTable with pagination and length dropdown disabled
            new DataTable('#example', {
                paging: false, // Disable pagination
                lengthChange: false, // Disable the "Show entries" dropdown
                searching: true // Keep the search functionality
            });

            const selectAllCheckbox = document.getElementById("selectAll");
            const userCheckboxes = document.querySelectorAll(".user-checkbox");
            const previewEmails = document.getElementById("previewEmails");
            const sendEmailsButton = document.getElementById("sendEmails");
            const messageTextarea = document.getElementById("message");

            function updatePreview() {
                const selectedEmails = Array.from(userCheckboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.getAttribute("data-email"));

                if (selectedEmails.length > 0) {
                    let emailPreviewHTML = '';
                    selectedEmails.forEach(email => {
                        emailPreviewHTML += `<p>${email}</p>`;
                    });
                    previewEmails.innerHTML = emailPreviewHTML;
                } else {
                    previewEmails.innerHTML = '<p class="text-muted">No emails selected...</p>';
                }
            }

            // Handle "Select All" checkbox change
            selectAllCheckbox.addEventListener("change", function () {
                const isChecked = selectAllCheckbox.checked;
                userCheckboxes.forEach(checkbox => {
                    checkbox.checked = isChecked;
                });
                updatePreview();
            });

            // Handle individual checkbox change
            userCheckboxes.forEach(checkbox => {
                checkbox.addEventListener("change", updatePreview);
            });

            // Handle sending emails
            sendEmailsButton.addEventListener("click", function () {
                const selectedEmails = Array.from(userCheckboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.getAttribute("data-email"));

                const message = messageTextarea.value.trim();

                if (selectedEmails.length === 0) {
                    alert("Please select at least one email to send the message.");
                    return;
                }

                if (message === "") {
                    alert("Please enter a message.");
                    return;
                }

                // Send email using EmailJS
                selectedEmails.forEach(email => {
                    emailjs.send("service_zjua5qh", "template_5qrz0w3", {
                        to_email: email,
                        message: message,
                    })
                    .then(response => {
                        console.log("SUCCESS!", response.status, response.text);
                        alert(`Email sent to ${email}`);
                        window.location.reload();
                    })
                    .catch(error => {
                        console.error("FAILED...", error);
                        alert(`Failed to send email to ${email}`);
                    });
                });
            });
        });
    </script>

@endsection
