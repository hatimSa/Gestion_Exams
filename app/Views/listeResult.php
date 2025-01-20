<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage results</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .header {
            background-color: #6e7cb2;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #6e7cb2;
            color: #fff;
        }

        .btn {
            padding: 5px 10px;
            border: none;
            color: #fff;
            cursor: pointer;
            margin: 0 5px;
            text-decoration: none;
            border-radius: 3px;
        }

        .btn-edit {
            background-color: #4caf50;
        }

        .btn-delete {
            background-color: #f44336;
        }

        .btn-add {
            background-color: #6e7cb2;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 10px;
        }

        /* Style for the Modal */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .btn-submit {
            background-color: #4caf50;
            padding: 10px 15px;
            border: none;
            color: white;
            cursor: pointer;
            text-align: center;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <?php echo view('profSidebar'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Manage Results</h1>
        </div>

        <div class="card">
            <!-- Link to Open Modal -->
            <a href="javascript:void(0);" class="btn btn-add" id="add-exam-btn"><i class="fas fa-plus"></i> Add Result</a>

            <table>
                <thead>
                    <tr>
                        <th>Result id</th>
                        <th>Student id</th>
                        <th>Student Lastname</th>
                        <th>Student Fistname</th>
                        <th>Result</th>
                        <th>Exam ID</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>12</td>
                        <td>Achour</td>
                        <td>Fati</td>
                        <td>15.00/td>
                        <td>1</td>
                        <td>
                            <a href="javascript:void(0);" class="btn btn-edit" id="edit-exam-btn"><i class="fas fa-edit"></i> Edit</a>
                            <a href="/delete-exam?id=1" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this exam?');"><i class="fas fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p>No results found. Click "Add New Exam" to create one.</p>
        </div>
    </div>

    <!-- Modal for Add Exam -->
    <div id="addExamModal" class="modal">
        <div class="modal-content">
            <span class="close" id="close-add-modal">&times;</span>
            <h2>Add New Exam</h2>
            <form action="/add-exam" method="POST">
                <div class="form-group">
                    <label for="module">Module</label>
                    <input type="text" id="module" name="module" required>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="start-time">Start Time</label>
                    <input type="time" id="start-time" name="start_time" required>
                </div>
                <div class="form-group">
                    <label for="end-time">End Time</label>
                    <input type="time" id="end-time" name="end_time" required>
                </div>
                <div class="form-group">
                    <label for="filiere">Filière</label>
                    <select id="filiere" name="filiere" required>
                        <option value="Science">Science</option>
                        <option value="Arts">Arts</option>
                        <option value="Commerce">Commerce</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="responsable">Responsable</label>
                    <input type="text" id="responsable" name="responsable" required>
                </div>
                <button type="submit" class="btn-submit">Add Exam</button>
            </form>
        </div>
    </div>

    <!-- Modal for Edit Exam -->
    <div id="editExamModal" class="modal">
        <div class="modal-content">
            <span class="close" id="close-edit-modal">&times;</span>
            <h2>Edit Exam</h2>
            <form action="/update-exam?id=1" method="POST">
                <div class="form-group">
                    <label for="module">Module</label>
                    <input type="text" id="module" name="module" value="Mathematics" required>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" value="2025-01-25" required>
                </div>
                <div class="form-group">
                    <label for="start-time">Start Time</label>
                    <input type="time" id="start-time" name="start_time" value="10:00" required>
                </div>
                <div class="form-group">
                    <label for="end-time">End Time</label>
                    <input type="time" id="end-time" name="end_time" value="12:00" required>
                </div>
                <div class="form-group">
                    <label for="filiere">Filière</label>
                    <select id="filiere" name="filiere" required>
                        <option value="Science" selected>Science</option>
                        <option value="Arts">Arts</option>
                        <option value="Commerce">Commerce</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="responsable">Responsable</label>
                    <input type="text" id="responsable" name="responsable" value="Prof. John Doe" required>
                </div>
                <button type="submit" class="btn-submit">Update Exam</button>
            </form>
        </div>
    </div>

    <script>
        // Modal Handling (generic function for both add and edit modals)
        function handleModal(modalId, btnId, closeBtnId) {
            var modal = document.getElementById(modalId);
            var btn = document.getElementById(btnId);
            var closeBtn = document.getElementById(closeBtnId);

            btn.onclick = function () {
                modal.style.display = 'block';
            }

            closeBtn.onclick = function () {
                modal.style.display = 'none';
            }

            window.onclick = function (event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            }
        }

        handleModal('addExamModal', 'add-exam-btn', 'close-add-modal');
        handleModal('editExamModal', 'edit-exam-btn', 'close-edit-modal');
    </script>

</body>

</html>
