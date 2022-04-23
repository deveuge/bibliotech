<!DOCTYPE html>
<html lang="es">
@include('plantillas.header', ['titulo' => "Inicio", 'estilo' => 'index.css'])

<body class="container-fluid">
	<div class="row justify-content-center align-items-center">

		<aside class="col-12 col-lg-6 bg-primary">
			<div id="logo">
				<img src="img/logo.svg" />
				<span>biblio<strong>tech</strong></span>
			</div>
			<div id="caracteristicas" class="text-light my-auto">
				<div id="carouselIndicators" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-indicators">
						<button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="0"
							class="active" aria-current="true" aria-label="Slide 1"></button>
						<button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="1"
							aria-label="Slide 2"></button>
						<button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="2"
							aria-label="Slide 3"></button>
					</div>
					<div class="carousel-inner">
						<div class="carousel-item active">
							<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 511.761 511.761" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><g xmlns="http://www.w3.org/2000/svg"><path d="m504.38 496.761h-20.959v-226.731l16.326-33.067c1.769-6.099-.473-9.706-6.725-10.82h-92.744v-87.084l16.326-33.067c.495-1.005.775-2.205.775-3.32v-31.138c0-4.142-3.357-7.5-7.5-7.5h-25.287v-56.534c0-4.142-3.357-7.5-7.5-7.5h-39.001c-9.697 0-9.697 15 0 15h31.501v49.034h-24.001v-23.279c0-4.142-3.357-7.5-7.5-7.5h-164.423c-4.143 0-7.5 3.358-7.5 7.5v23.279h-24.001v-49.034h148.713c9.697 0 9.697-15 0-15h-156.213c-4.143 0-7.5 3.358-7.5 7.5v56.534h-25.287c-4.143 0-7.5 3.358-7.5 7.5v31.137c0 1.138.269 2.3.775 3.32l16.326 33.067v87.084h-93.466c-6.252 1.114-8.493 4.721-6.725 10.82l17.049 34.531v225.267h-20.959c-9.697 0-9.697 15 0 15h497c9.698.001 9.698-14.999 0-14.999zm-392.898-182.913h-68.143v-37.269h68.143zm2.466-203.677h283.865l-9.695 19.638h-264.475zm286.331 166.408h68.143v37.269h-68.143zm0 52.269h68.143v100.724h-68.143zm80.677-87.705-10.089 20.436h-70.587v-20.436zm-150.364-177.788h-67.573v-15.1h67.573zm-149.424-15.1h66.851v15.1h-66.851zm-71.788 30.779h293v16.137h-293zm2.102 162.109v20.436h-71.31l-10.089-20.436zm-68.143 203.428h68.143v52.189h-68.143zm160.148 52.19v-125.191h44.532v125.19h-44.532zm59.532 0v-125.191h45.255v125.19h-45.255zm60.255 0v-132.691c0-4.142-3.357-7.5-7.5-7.5h-119.787c-4.143 0-7.5 3.358-7.5 7.5v132.69h-62.005v-59.689-30.009c0-9.697-15-9.697-15 0v22.509h-68.143v-100.723h68.143v25.58c0 9.697 15 9.697 15 0v-33.08-176.539h258.797v351.952zm77.005 0v-52.189h68.143v52.189z" fill="#ffffff" ></path><path d="m351.329 195.254h-20.966v-6.294c0-3.356-2.229-6.303-5.458-7.217-1.628-.46-38.16-10.369-68.997 15.351-32.628-27.767-67.945-15.758-69.511-15.205-2.996 1.06-4.999 3.893-4.999 7.071v6.294h-20.966c-4.143 0-7.5 3.358-7.5 7.5v106.604c0 4.142 3.357 7.5 7.5 7.5h190.896c4.143 0 7.5-3.358 7.5-7.5v-106.604c.001-4.142-3.357-7.5-7.499-7.5zm-35.966-.136v78.161c-24.547-.829-41.426 8.173-51.982 17v-79.809c19.155-17.446 41.764-16.798 51.982-15.352zm-118.965-.326c9.673-1.815 31.601-3.113 51.982 15.666v78.811c-1-.869-2.058-1.735-3.174-2.591-8.844-6.78-22.899-13.974-42.723-13.974-1.972 0-4 .071-6.086.221v-78.133zm-28.466 15.462h13.466v71.119c0 2.206.971 4.299 2.654 5.724s3.904 2.039 6.083 1.673c25.147-4.205 41.021 4.812 49.9 13.089h-72.103zm175.897 91.605h-70.835c9.307-7.715 25.138-15.876 48.982-13.039 2.127.256 4.264-.416 5.867-1.839s2.52-3.464 2.52-5.608v-71.119h13.466z" fill="#ffffff" ></path></g></g></svg>
							<p>Bibliotech proporciona un sistema de gestión de bibliotecas automatizado y fácil de manejar</p>
						</div>
						<div class="carousel-item">
							<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" ><g><g xmlns="http://www.w3.org/2000/svg"><path d="m485.341 437.426h-13.18c-9.144-21.726-9.148-42.925-.01-64.542h13.19c14.7 0 26.659-11.959 26.659-26.66 0-14.7-11.959-26.66-26.659-26.66h-53.038c6.751-7.712 10.855-17.795 10.855-28.826v-83.53c0-24.166-19.659-43.826-43.824-43.826h-21.567c1.83-3.648 2.866-7.761 2.866-12.113 0-14.967-12.162-27.144-27.112-27.144h-7.419c-6.621-16.367-6.625-32.353-.011-48.615h7.43c14.95 0 27.112-12.177 27.112-27.144 0-14.95-12.162-27.113-27.112-27.113h-253.003c-43.328 0-78.578 35.237-78.578 78.549 0 20.946 8.186 40.667 23.048 55.53 2.955 2.955 6.109 5.634 9.419 8.049h-5.808c-14.7 0-26.659 11.959-26.659 26.66s11.959 26.66 26.659 26.66h13.19c9.138 21.615 9.135 42.815-.01 64.541h-13.18c-14.7 0-26.659 11.959-26.659 26.66 0 5.624 1.755 10.843 4.739 15.148-15.668 6.685-26.679 22.249-26.679 40.34v83.531c0 24.166 19.646 43.825 43.794 43.825h441.546c14.7 0 26.659-11.959 26.659-26.66.001-14.7-11.958-26.66-26.658-26.66zm0-102.862c6.429 0 11.659 5.231 11.659 11.66s-5.23 11.66-11.659 11.66h-135.357c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h106.078c-2.931 8.232-4.723 16.496-5.4 24.771 0 0-2.996 14.845 5.416 39.771h-400.588c-1.176 0-2.17-.994-2.17-2.171v-60.2c0-1.176.994-2.17 2.17-2.17h74.301l.005 24.632c-.473 7.374 3.128 10.28 5.339 11.36 2.241 1.096 6.845 2.157 12.51-3.021.039-.036.078-.072.116-.108l20.964-19.995 20.964 19.995c.038.037.077.073.116.108 3.316 3.031 6.268 3.926 8.599 3.926 1.665 0 3.013-.457 3.949-.918 2.214-1.09 5.81-4.01 5.301-11.367l.01-24.612h105.392c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-105.387l.01-23.32h277.662zm-402.059-93.09c-.676-8.275-2.503-16.538-5.432-24.771h309.82c1.177 0 2.171.994 2.171 2.17v60.2c0 1.176-.994 2.17-2.171 2.17h-179.969l.01-24.771h52.489c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-176.918zm46.49 39.77h-51.939c2.927-8.244 4.757-16.507 5.441-24.771h46.493zm62.939-24.77-.054 131.376-18.757-17.89c-2.897-2.764-7.455-2.764-10.353 0l-18.754 17.888-.027-131.375h47.945zm-155.771-156.671c0-35.041 28.521-63.549 63.578-63.549h253.003c6.679 0 12.112 5.434 12.112 12.113 0 6.696-5.434 12.144-12.112 12.144h-138.258c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h114.847c-5.294 16.134-5.287 32.411.02 48.615h-229.612c-6.45 0-12.557-2.541-17.167-7.128-4.614-4.638-7.155-10.744-7.155-17.195 0-13.395 10.911-24.292 24.322-24.292h77.817c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-77.817c-21.682 0-39.322 17.626-39.322 39.292 0 10.443 4.092 20.307 11.548 27.801 7.468 7.43 17.331 11.522 27.774 11.522h253.003c6.679 0 12.112 5.448 12.112 12.144 0 6.679-5.434 12.113-12.112 12.113h-253.003c-16.939 0-32.893-6.625-44.923-18.656-12.03-12.03-18.655-27.984-18.655-44.924zm11.659 101.9c-6.429 0-11.659-5.23-11.659-11.66 0-6.429 5.23-11.66 11.659-11.66h350.735c15.894 0 28.824 12.931 28.824 28.826v83.53c0 15.895-12.931 28.826-28.824 28.826h-191.649l.01-23.32h179.974c9.468 0 17.171-7.703 17.171-17.17v-60.2c0-9.468-7.703-17.17-17.171-17.17h-339.07zm0 94.541h81.176l.005 23.32h-81.18c-6.429 0-11.659-5.231-11.659-11.66-.001-6.429 5.229-11.66 11.658-11.66zm436.742 179.502h-441.547c-15.877 0-28.794-12.931-28.794-28.825v-83.531c0-15.895 12.917-28.826 28.794-28.826h85.988l.005 23.32h-74.297c-9.468 0-17.17 7.703-17.17 17.17v60.2c0 9.468 7.703 17.171 17.17 17.171h429.851c6.429 0 11.659 5.231 11.659 11.66s-5.23 11.661-11.659 11.661z" fill="#ffffff"></path></g></g></svg>
							<p>Compruebe los libros que ha tomado prestados y su fecha de devolución</p>
						</div>
						<div class="carousel-item">
							<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 511.963 511.963" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><path xmlns="http://www.w3.org/2000/svg" d="m343.951 303.162c-3.144-4.542-9.374-5.672-13.915-2.529-21.82 15.108-47.428 23.094-74.055 23.094-71.831 0-130.27-58.439-130.27-130.27s58.438-130.27 130.27-130.27 130.27 58.438 130.27 130.27c0 14.629-2.413 29-7.171 42.715-1.811 5.218.952 10.915 6.169 12.725 5.216 1.812 10.915-.952 12.725-6.169 5.492-15.828 8.276-32.404 8.276-49.271 0-82.859-67.411-150.27-150.27-150.27s-150.27 67.411-150.27 150.27 67.411 150.27 150.27 150.27c30.715 0 60.26-9.216 85.44-26.651 4.543-3.144 5.675-9.373 2.531-13.914z" fill="#ffffff"></path><path xmlns="http://www.w3.org/2000/svg" d="m366.193 491.946h-69.563c.85-1.104 1.674-2.232 2.44-3.415l122.818-189.41c.12-.185.233-.373.339-.563 19.196-30.921 29.331-66.565 29.311-103.11-.059-107.604-87.647-195.282-195.249-195.448-.105 0-.204 0-.31 0-52.178 0-101.241 20.297-138.17 57.17-37.004 36.948-57.384 86.094-57.384 138.386 0 36.506 10.134 72.112 29.31 103.001.107.191.22.379.34.564l122.818 189.41c.766 1.182 1.591 2.311 2.44 3.415h-90.497c-5.523 0-10 4.477-10 10s4.477 10 10 10h241.357c5.523 0 10-4.477 10-10s-4.477-10-10-10zm-136.519-14.296-122.559-189.01c-.05-.085-.102-.171-.154-.255-17.36-27.807-26.536-59.907-26.536-92.829 0-46.944 18.295-91.064 51.515-124.233 33.155-33.103 77.195-51.323 124.04-51.323h.277c96.597.149 175.228 78.86 175.28 175.459.018 32.958-9.158 65.091-26.536 92.926-.053.085-.104.17-.155.256l-122.558 189.009c-5.891 9.085-15.479 14.295-26.307 14.295-10.827.001-20.416-5.21-26.307-14.295z" fill="#ffffff"></path><path xmlns="http://www.w3.org/2000/svg" d="m427.861 498.18c-3.395-8.283-15.633-7.961-18.646.455-3.11 8.686 6.742 16.654 14.598 11.908 4.161-2.514 5.919-7.873 4.048-12.363z" fill="#ffffff"></path><path xmlns="http://www.w3.org/2000/svg" d="m324.308 129.718c-3.71 0-7.451-.824-10.818-2.382l-9.386-4.344c-5.981-2.768-12.627-4.231-19.219-4.231-10.637 0-20.756 3.633-28.904 10.292-8.148-6.658-18.266-10.292-28.904-10.292-6.592 0-13.238 1.463-19.218 4.231l-9.386 4.344c-3.368 1.558-7.108 2.382-10.818 2.382h-6.381c-5.523 0-10 4.477-10 10v109.407c0 7.427 6.437 10 12.728 10 5.518 0 16.163-1.127 22.872-4.231l9.387-4.344c3.366-1.558 7.106-2.382 10.817-2.382 6.743 0 13.12 2.588 17.954 7.288 3.171 3.082 6.13 6.69 10.95 6.699 4.815.008 7.787-3.624 10.95-6.699 4.834-4.7 11.211-7.288 17.954-7.288 3.711 0 7.451.824 10.818 2.382l9.387 4.344c6.708 3.104 17.353 4.231 22.871 4.231 6.294 0 12.728-2.567 12.728-10v-109.407c0-5.523-4.477-10-10-10zm-97.23 98.449c-6.592 0-13.238 1.463-19.218 4.231l-9.386 4.344c-1.448.67-4.21 1.32-7.199 1.771v-88.942c5.381-.433 10.711-1.824 15.599-4.085l9.387-4.344c3.366-1.558 7.106-2.382 10.817-2.382 6.743 0 13.12 2.588 17.954 7.288l.95.923v85.262c-5.868-2.662-12.287-4.066-18.904-4.066zm93.611 10.347c-2.989-.451-5.751-1.101-7.199-1.771l-9.386-4.344c-5.981-2.768-12.627-4.231-19.219-4.231-6.618 0-13.036 1.403-18.904 4.067v-85.262l.95-.923c4.834-4.7 11.211-7.288 17.954-7.288 3.711 0 7.451.824 10.818 2.382l9.387 4.344c4.887 2.262 10.217 3.652 15.599 4.085z" fill="#ffffff"></path><path xmlns="http://www.w3.org/2000/svg" d="m377.241 274.05c-1.639-3.934-5.715-6.452-9.971-6.135-4.169.311-7.777 3.274-8.895 7.3-2.374 8.552 7.2 15.745 14.772 11.235 4.218-2.511 5.947-7.881 4.094-12.4z" fill="#ffffff"></path></g></svg>
							<p>Busque en un amplio catálogo los libros disponibles para tomar prestados</p>
						</div>
					</div>
				</div>
			</div>
		</aside>

		<main class="col-12 col-lg-6 py-4 justify-content-center bg-white">

			<div class="tab-content" id="pills-tabContent">
				
				<!-- Navegación -->
				<div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
					<button class="nav-link {{isset($mostrarRegistro) ?: 'active'}}" id="pills-login-tab" data-bs-toggle="tab" data-bs-target="#pills-login"
						type="button" role="tab" aria-controls="pills-login" aria-selected="true">Iniciar sesión</button>
					<span class="mx-2">o</span>
					<button class="nav-link {{isset($mostrarRegistro) ? 'active' : ''}}" id="pills-register-tab" data-bs-toggle="pill" data-bs-target="#pills-register"
						type="button" role="tab" aria-controls="pills-register" aria-selected="false">Registrarse</button>
				</div>

				<!-- Iniciar sesión -->
				<div class="tab-pane fade {{isset($mostrarRegistro) ?: 'show active'}} " id="pills-login" role="tabpanel"
					aria-labelledby="pills-login-tab">
					<div class="alert alert-primary text-center">
						<h5>Bienvenido de nuevo</h5>
						<span>Introduzca sus credenciales para acceder</span>
					</div>
					<form id="login-form" action="index.php" method="POST">
						<div class="form-floating mb-3">
							<input type="email" class="form-control" id="l-email" name="l-email" placeholder="Email" autofocus="autofocus" required>
							<label for="l-email">Email</label>
						</div>
						<div class="form-floating mb-3">
							<input type="password" class="form-control" placeholder="Contraseña" id="l-password" name="l-password" required>
							<label for="l-password">Contraseña</label>
						</div>
						<div class="d-grid gap-2 mt-2">
							<button type="submit" class="btn btn-primary text-light">Iniciar sesión</button>
						</div>
						<input type="hidden" name="accion" value="login"/>
					</form>
				</div>

				<!-- Registrarse -->
				<div class="tab-pane fade {{isset($mostrarRegistro) ? 'show active' : ''}}" id="pills-register" role="tabpanel"
					aria-labelledby="pills-register-tab">
					<div class="alert alert-primary text-center">
						<h5>Cree una nueva cuenta</h5>
						<span>Introduzca sus datos para registrarse</span>
					</div>
					<form id="register-form" action="index.php" method="POST">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="r-usuario" name="r-usuario" placeholder="Nombre de usuario" autofocus="autofocus" required>
							<label for="r-usuario">Nombre de usuario</label>
						</div>
						<div class="form-floating mb-3">
							<input type="email" class="form-control" id="r-email" name="r-email" placeholder="Email" required>
							<label for="r-email">Email</label>
						</div>
						<div class="form-floating mb-3">
							<input type="password" class="form-control" id="r-password" name="r-password" placeholder="Contraseña" required>
							<label for="r-password">Contraseña</label>
						</div>
						<div class="form-floating mb-3">
							<input type="password" class="form-control" id="r-password-repeat" name="r-password-repeat" placeholder="Contraseña" required>
							<label for="r-password-repeat">Repetir contraseña</label>
						</div>

						<div class="d-grid gap-2 mt-2">
							<button type="submit" class="btn btn-primary text-light">Registrarse</button>
						</div>
						<input type="hidden" name="accion" value="register"/>
					</form>
				</div>
			</div>

		</main>
	</div>

	@include('plantillas.scripts')
</body>
</html>