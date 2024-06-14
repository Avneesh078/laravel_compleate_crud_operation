<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            max-width: 600px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
            border: 1px solid #ddd;
            /* Height reduce karne ke liye */
            height: 100%; /* Set the height to 90% of the viewport height */
            overflow-y: auto; /* Add a vertical scroll if the content overflows */
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form-group img {
            display: block;
            margin-top: 10px;
            max-width: 150px;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .form-group label {
            font-weight: bold;
            color: #555;
        }
        .btn-success {
            width: 100%;
            padding: 10px;
            font-size: 1.1em;
        }
        .alert {
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .mb-3 {
            margin-bottom: 1.5rem!important;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Form</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(!$data)
            <div class="alert alert-danger">
                Data not found.
            </div>
        @else
            <form action="{{ route('form.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="profile_image">Profile Image:</label>
                    <input type="file" name="profile_image" id="profile_image" class="form-control">
                    @if($data->profile_image)
                        <img src="{{ Storage::url($data->profile_image) }}" alt="Profile Image" class="img-thumbnail mt-2">
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $data->name) }}">
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="number" name="phone" id="phone" class="form-control" value="{{ old('phone', $data->phone) }}">
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $data->email) }}">
                </div>
                
                <div class="form-group">
                    <label for="street_address">Street Address:</label>
                    <textarea name="street_address" id="street_address" class="form-control">{{ old('street_address', $data->street_address) }}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $data->city) }}">
                </div>
                
                <div class="form-group">
                    <label for="state">State:</label>
                    <select name="state" id="state" class="form-control">
                        <option value="">Select State</option>
                        <option value="Mp">Mp</option>
                        <option value="Up">Up</option>
                        <option value="Delhi">Delhi</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="country">Country:</label>
                    <select name="country" id="country" class="form-control">
                        <option value="">Select Country</option>
                        <option value="USA">USA</option>
                        <option value="Canada">Canada</option>
                        <option value="India">India</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-success">Update</button>
            </form>
        @endif
    </div>
</body>
</html>
