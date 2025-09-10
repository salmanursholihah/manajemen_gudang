<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <title>manajemen gudang</title>
    @vite('resources/css/app.css')
      <style>
body {
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  margin: 0;
  padding: 0;
  background: #f6fbfc;
  overflow-x: hidden;
  position: relative;
}

/* === ORNAMENT BACKGROUND === */
.bg-shape {
  position: absolute;
  top: -100px;
  right: -150px;
  width: 600px;
  height: 600px;
  background: radial-gradient(circle, #b2f2e6 0%, #5cd3b4 80%);
  border-radius: 50%;
  opacity: 0.4;
  z-index: -1;
}

.bg-shape2 {
  position: absolute;
  bottom: -150px;
  left: -200px;
  width: 500px;
  height: 500px;
  background: radial-gradient(circle, #c9f9ec 0%, #a5f1d6 90%);
  border-radius: 50%;
  opacity: 0.3;
  z-index: -1;
}

/* === LAYOUT === */
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 80vh;
  padding: 40px;
}

.card {
  display: flex;
  width: 950px;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 6px 20px rgba(0,0,0,0.1);
  background: #fff;
  position: relative;
  z-index: 2;
}

/* LEFT FORM */
.form-container {
  flex: 1;
  padding: 50px;
}

.tabs {
  display: flex;
  margin-bottom: 25px;
  border-bottom: 1px solid #eee;
}

.tab {
  margin-right: 20px;
  padding-bottom: 8px;
  font-weight: 600;
  color: #999;
  cursor: pointer;
  transition: color 0.3s;
}

.tab.active {
  color: #00897b;
  border-bottom: 2px solid #00897b;
}

/* RIGHT ILLUSTRATION */
.illustration {
  flex: 1;
  background: linear-gradient(135deg, #c9f9ec, #5cd3b4);
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 40px;
}

.illustration img {
  max-width: 85%;
}
 </style>
</head>

<body class="bg-gray-100">

    <div class="flex h-screen">

        <!-- Main Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

</body>
</html>



