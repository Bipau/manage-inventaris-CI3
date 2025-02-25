<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>InventoPro - Inventory Management System</title>
	<style>
		/* Reset and base styles */
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
			line-height: 1.6;
			color: #333;
		}

		/* Navigation */
		nav {
			background: white;
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
			position: fixed;
			width: 100%;
			z-index: 1000;
		}

		.nav-container {
			max-width: 1200px;
			margin: 0 auto;
			padding: 1rem;
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		.logo {
			display: flex;
			align-items: center;
			gap: 0.5rem;
		}

		.logo img {
			width: 32px;
			height: 32px;
		}

		.logo span {
			font-size: 1.5rem;
			font-weight: bold;
			color: #2563eb;
		}

		.nav-links {
			display: flex;
			gap: 2rem;
			list-style: none;
		}

		.nav-links a {
			text-decoration: none;
			color: #4b5563;
			font-weight: 500;
			transition: color 0.3s;
		}

		.nav-links a:hover {
			color: #2563eb;
		}

		/* Hero Section */
		.hero {
			background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
			padding: 8rem 1rem 4rem;
			color: white;
		}

		.hero-content {
			max-width: 1200px;
			margin: 0 auto;
			display: flex;
			align-items: center;
			gap: 4rem;
		}

		.hero-text {
			flex: 1;
		}

		.hero-text h1 {
			font-size: 3.5rem;
			line-height: 1.2;
			margin-bottom: 1.5rem;
		}

		.hero-text p {
			font-size: 1.25rem;
			margin-bottom: 2rem;
			opacity: 0.9;
		}

		.hero-image {
			flex: 1;
		}

		.hero-image img {
			width: 100%;
			border-radius: 0.5rem;
			box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
		}

		/* Features Section */
		.features {
			padding: 5rem 1rem;
			background: #f9fafb;
		}

		.features h2 {
			text-align: center;
			font-size: 2.5rem;
			margin-bottom: 4rem;
			color: #1f2937;
		}

		.features-grid {
			max-width: 1200px;
			margin: 0 auto;
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
			gap: 2rem;
		}

		.feature-card {
			background: white;
			padding: 2rem;
			border-radius: 0.5rem;
			box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
			transition: transform 0.3s, box-shadow 0.3s;
		}

		.feature-card:hover {
			transform: translateY(-5px);
			box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
		}

		.feature-card img {
			width: 48px;
			height: 48px;
			margin-bottom: 1.5rem;
		}

		.feature-card h3 {
			font-size: 1.5rem;
			margin-bottom: 1rem;
			color: #1f2937;
		}

		.feature-card p {
			color: #6b7280;
		}

		/* Benefits Section */
		.benefits {
			padding: 5rem 1rem;
		}

		.benefits h2 {
			text-align: center;
			font-size: 2.5rem;
			margin-bottom: 4rem;
			color: #1f2937;
		}

		.benefits-grid {
			max-width: 1200px;
			margin: 0 auto;
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
			gap: 2rem;
		}

		.benefit-item {
			display: flex;
			align-items: center;
			gap: 1rem;
			padding: 1.5rem;
			background: white;
			border-radius: 0.5rem;
			box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
		}

		.benefit-item img {
			width: 24px;
			height: 24px;
			color: #10b981;
		}

		/* Contact Section */
		.contact {
			padding: 5rem 1rem;
			background: #f9fafb;
		}

		.contact-content {
			max-width: 600px;
			margin: 0 auto;
			text-align: center;
		}

		.contact-content h2 {
			font-size: 2.5rem;
			margin-bottom: 1.5rem;
			color: #1f2937;
		}

		.contact-content p {
			color: #6b7280;
			margin-bottom: 2rem;
		}

		/* Footer */
		footer {
			background: #1f2937;
			color: white;
			padding: 2rem 1rem;
		}

		.footer-content {
			max-width: 1200px;
			margin: 0 auto;
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		.footer-logo {
			display: flex;
			align-items: center;
			gap: 0.5rem;
		}

		.footer-logo img {
			width: 24px;
			height: 24px;
		}

		.footer-copyright {
			color: #9ca3af;
		}

		/* Buttons */
		.cta-button {
			background: white;
			color: #2563eb;
			border: none;
			padding: 1rem 2rem;
			font-size: 1.125rem;
			font-weight: 600;
			border-radius: 0.5rem;
			cursor: pointer;
			transition: all 0.3s;
		}

		.hero .cta-button {
			background: white;
			color: #2563eb;
		}

		.contact .cta-button {
			background: #2563eb;
			color: white;
		}

		.cta-button:hover {
			transform: translateY(-2px);
			box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
		}

		/* Responsive Design */
		@media (max-width: 768px) {
			.hero-content {
				flex-direction: column;
				text-align: center;
			}

			.hero-text h1 {
				font-size: 2.5rem;
			}

			.nav-links {
				display: none;
			}

			.footer-content {
				flex-direction: column;
				gap: 1rem;
				text-align: center;
			}
		}
	</style>
</head>

<body>
	<!-- Navigation -->
	<nav>
		<div class="nav-container">
			<div class="logo">
				<img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/package-2.svg" alt="Logo">
				<span>InventoPro</span>
			</div>
			<ul class="nav-links">
				<li><a href="#features">Home</a></li>
				<li><a href="<?= base_url('AuthController/index')?>">Login</a></li>
				<li><a href="<?= base_url('RegisterController/index')?>">Registrasi</a></li>
			</ul>
		</div>
	</nav>

	<!-- Hero Section -->
	<header class="hero">
		<div class="hero-content">
			<div class="hero-text">
				<h1>Manage Your Inventory Smarter</h1>
				<p>Streamline your inventory management with our powerful and intuitive system. Track, manage, and optimize your stock in real-time.</p>
				<button class="cta-button">Get Started →</button>
			</div>
			<div class="hero-image">
				<img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Warehouse Management">
			</div>
		</div>
	</header>

	<!-- Features Section -->
	<secti id="features" class="features">
		<h2>Powerful Features for Your Business</h2>
		<div class="features-grid">
			<div class="feature-card">
				<img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/bar-chart-3.svg" alt="Analytics">
				<h3>Real-time Analytics</h3>
				<p>Track your inventory metrics and make data-driven decisions with comprehensive analytics.</p>
			</div>
			<div class="feature-card">
				<img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/shield.svg" alt="Security">
				<h3>Secure Management</h3>
				<p>Enterprise-grade security to protect your valuable inventory data.</p>
			</div>
			<div class="feature-card">
				<img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/users.svg" alt="Collaboration">
				<h3>Team Collaboration</h3>
				<p>Work together efficiently with role-based access control and real-time updates.</p>
			</div>
		</div>
	</secti<?= base_url('AuthController/index')?>- Login Section -->
	<section id="b<?= base_url('RegisterController')?> class="benefits">
		<h2>Why Choose InventoPro?</h2>
		<div class="benefits-grid">
			<div class="benefit-item">
				<img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/check-circle.svg" alt="Check">
				<span>Reduce inventory costs by up to 30%</span>
			</div>
			<div class="benefit-item">
				<img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/check-circle.svg" alt="Check">
				<span>Eliminate stockouts and overstock situations</span>
			</div>
			<div class="benefit-item">
				<img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/check-circle.svg" alt="Check">
				<span>Increase operational efficiency</span>
			</div>
			<div class="benefit-item">
				<img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/check-circle.svg" alt="Check">
				<span>24/7 customer support</span>
			</div>
		</div>
	</section>

	<!-- Contact Section -->
	<section id="contact" class="contact">
		<div class="contact-content">
			<h2>Ready to Get Started?</h2>
			<p>Contact us today to learn how InventoPro can transform your inventory management.</p>
			<button class="cta-button">Contact Us</button>
		</div>
	</section>

	<!-- Footer -->
	<footer>
		<div class="footer-content">
			<div class="footer-logo">
				<img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/package-2.svg" alt="Logo">
				<span>InventoPro</span>
			</div>
			<div class="footer-copyright">
				© 2024 InventoPro. All rights reserved.
			</div>
		</div>
	</footer>
</body>

</html>
