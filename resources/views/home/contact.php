<?php
/**
 * Contact Page
 * Get in touch with PEANECH ERP team
 */
$pageTitle = 'Contact Us - Get In Touch';
$activeMenu = 'contact';

ob_start();
?>

<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600 text-white overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute w-96 h-96 bg-white/10 rounded-full blur-3xl -top-48 -left-48 animate-pulse"></div>
        <div class="absolute w-96 h-96 bg-white/10 rounded-full blur-3xl -bottom-48 -right-48 animate-pulse delay-1000"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28">
        <div class="text-center max-w-4xl mx-auto">
            <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full mb-6">
                <i data-feather="mail" class="w-5 h-5 mr-2 stroke-current"></i>
                <span class="text-sm font-semibold">We're Here to Help</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                Let's Start a
                <span class="block bg-gradient-to-r from-yellow-300 to-pink-300 bg-clip-text text-transparent">
                    Conversation
                </span>
            </h1>
            
            <p class="text-xl md:text-2xl text-blue-100 mb-8 leading-relaxed">
                Have questions? We're ready to help you transform your business with PEANECH ERP
            </p>
            
            <!-- Quick Contact Stats -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6 max-w-2xl mx-auto">
                <div class="text-center">
                    <div class="text-3xl font-bold mb-1">24/7</div>
                    <div class="text-sm text-blue-200">Support Available</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold mb-1">&lt;1hr</div>
                    <div class="text-sm text-blue-200">Average Response</div>
                </div>
                <div class="text-center col-span-2 md:col-span-1">
                    <div class="text-3xl font-bold mb-1">98%</div>
                    <div class="text-sm text-blue-200">Customer Satisfaction</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Wave Separator -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
            <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="rgb(249, 250, 251)"/>
        </svg>
    </div>
</section>

<!-- Contact Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12">
            
            <!-- Contact Form -->
            <div class="bg-white rounded-2xl shadow-xl p-8 md:p-10">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-3">Send Us a Message</h2>
                    <p class="text-gray-600">Fill out the form below and our team will get back to you within 24 hours.</p>
                </div>
                
                <form id="contact-form" class="space-y-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="John Doe"
                        >
                    </div>
                    
                    <!-- Email & Phone -->
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="john@example.com"
                            >
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                Phone Number
                            </label>
                            <input 
                                type="tel" 
                                id="phone" 
                                name="phone"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="+1 (555) 123-4567"
                            >
                        </div>
                    </div>
                    
                    <!-- Company & Subject -->
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label for="company" class="block text-sm font-semibold text-gray-700 mb-2">
                                Company Name
                            </label>
                            <input 
                                type="text" 
                                id="company" 
                                name="company"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Your Company"
                            >
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">
                                Subject <span class="text-red-500">*</span>
                            </label>
                            <select 
                                id="subject" 
                                name="subject" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            >
                                <option value="">Select a subject</option>
                                <option value="sales">Sales Inquiry</option>
                                <option value="support">Technical Support</option>
                                <option value="demo">Request a Demo</option>
                                <option value="partnership">Partnership Opportunity</option>
                                <option value="feedback">Feedback</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Message -->
                    <div>
                        <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                            Message <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="message" 
                            name="message" 
                            rows="5" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-none"
                            placeholder="Tell us how we can help you..."
                        ></textarea>
                    </div>
                    
                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full px-6 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-2xl transition-all flex items-center justify-center"
                    >
                        <i data-feather="send" class="w-5 h-5 mr-2 stroke-current"></i>
                        Send Message
                    </button>
                    
                    <p class="text-sm text-gray-500 text-center">
                        We respect your privacy. Your information will never be shared.
                    </p>
                </form>
            </div>
            
            <!-- Contact Information -->
            <div class="space-y-6">
                <!-- Office Address -->
                <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <i data-feather="map-pin" class="w-6 h-6 text-blue-600 stroke-current"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Office Address</h3>
                            <p class="text-gray-600">
                                C.O PEANECH APHIVAT CO., LTD.<br>
                                Phnom Penh, Cambodia
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Phone -->
                <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <i data-feather="phone" class="w-6 h-6 text-green-600 stroke-current"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Phone</h3>
                            <p class="text-gray-600 mb-2">
                                <a href="tel:+85512345678" class="hover:text-blue-600 transition">+855 12 345 678</a>
                            </p>
                            <p class="text-sm text-gray-500">Mon-Fri: 8:00 AM - 6:00 PM (ICT)</p>
                        </div>
                    </div>
                </div>
                
                <!-- Email -->
                <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <i data-feather="mail" class="w-6 h-6 text-purple-600 stroke-current"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Email</h3>
                            <p class="text-gray-600 mb-1">
                                <a href="mailto:info@peanech.com" class="hover:text-blue-600 transition">info@peanech.com</a>
                            </p>
                            <p class="text-gray-600">
                                <a href="mailto:support@peanech.com" class="hover:text-blue-600 transition">support@peanech.com</a>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Business Hours -->
                <div class="bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl shadow-lg p-8 text-white">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <i data-feather="clock" class="w-6 h-6 text-white stroke-current"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold mb-3">Business Hours</h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-blue-100">Monday - Friday:</span>
                                    <span class="font-semibold">8:00 AM - 6:00 PM</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-100">Saturday:</span>
                                    <span class="font-semibold">9:00 AM - 1:00 PM</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-100">Sunday:</span>
                                    <span class="font-semibold">Closed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Follow Us</h3>
                    <div class="flex items-center space-x-4">
                        <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white hover:bg-blue-700 transition" title="Facebook">
                            <i data-feather="facebook" class="w-5 h-5 stroke-current"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-400 rounded-full flex items-center justify-center text-white hover:bg-blue-500 transition" title="Twitter">
                            <i data-feather="twitter" class="w-5 h-5 stroke-current"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-700 rounded-full flex items-center justify-center text-white hover:bg-blue-800 transition" title="LinkedIn">
                            <i data-feather="linkedin" class="w-5 h-5 stroke-current"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-white hover:bg-gray-900 transition" title="GitHub">
                            <i data-feather="github" class="w-5 h-5 stroke-current"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Find Us on the Map
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Visit our office or schedule an in-person consultation
            </p>
        </div>
        
        <div class="relative rounded-2xl overflow-hidden shadow-2xl">
            <!-- Google Map Embed -->
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5489.957698858292!2d103.88558418661698!3d13.35112683732711!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311017ec211e1aaf%3A0x4bf0f2d8d2db4ef3!2sC.O%20PEANECH%20APHIVAT%20CO.%2C%20LTD.!5e0!3m2!1sen!2skh!4v1750666157320!5m2!1sen!2skh" 
                width="100%" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"
                class="w-full"
            ></iframe>
            
            <!-- View Full Map Button Overlay -->
            <div class="absolute bottom-6 right-6">
                <a 
                    href="https://www.google.com/maps/place/C.O+PEANECH+APHIVAT+CO.,+LTD./@13.3511268,103.8855842,17z/" 
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-xl hover:bg-green-700 hover:shadow-2xl transition-all"
                >
                    <i data-feather="map" class="w-5 h-5 mr-2 stroke-current"></i>
                    View Full Map
                </a>
            </div>
        </div>
        
        <!-- Directions Info -->
        <div class="mt-8 grid md:grid-cols-3 gap-6">
            <div class="bg-gray-50 rounded-xl p-6 text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full mb-4">
                    <i data-feather="navigation" class="w-6 h-6 text-blue-600 stroke-current"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Easy to Find</h3>
                <p class="text-sm text-gray-600">Located in central Phnom Penh with easy access</p>
            </div>
            
            <div class="bg-gray-50 rounded-xl p-6 text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-green-100 rounded-full mb-4">
                    <i data-feather="car" class="w-6 h-6 text-green-600 stroke-current"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Free Parking</h3>
                <p class="text-sm text-gray-600">Ample parking space available for visitors</p>
            </div>
            
            <div class="bg-gray-50 rounded-xl p-6 text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-purple-100 rounded-full mb-4">
                    <i data-feather="coffee" class="w-6 h-6 text-purple-600 stroke-current"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Welcoming Space</h3>
                <p class="text-sm text-gray-600">Comfortable waiting area with refreshments</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Frequently Asked Questions
            </h2>
            <p class="text-xl text-gray-600">
                Quick answers to common questions
            </p>
        </div>
        
        <div class="space-y-6">
            <!-- FAQ 1 -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <button class="w-full flex items-start justify-between text-left" onclick="toggleFAQ(this)">
                    <h3 class="text-lg font-semibold text-gray-900 pr-8">
                        What's the best way to contact you?
                    </h3>
                    <i data-feather="chevron-down" class="w-6 h-6 text-gray-400 flex-shrink-0 transition-transform stroke-current"></i>
                </button>
                <div class="faq-answer mt-4 text-gray-600 hidden">
                    For urgent inquiries, we recommend calling us directly during business hours. For general questions, the contact form above is perfect. We typically respond to form submissions within 24 hours.
                </div>
            </div>
            
            <!-- FAQ 2 -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <button class="w-full flex items-start justify-between text-left" onclick="toggleFAQ(this)">
                    <h3 class="text-lg font-semibold text-gray-900 pr-8">
                        Can I schedule a demo or consultation?
                    </h3>
                    <i data-feather="chevron-down" class="w-6 h-6 text-gray-400 flex-shrink-0 transition-transform stroke-current"></i>
                </button>
                <div class="faq-answer mt-4 text-gray-600 hidden">
                    Absolutely! Select "Request a Demo" in the subject field of the contact form, or call us directly to schedule a personalized demonstration of PEANECH ERP. We offer both virtual and in-person consultations.
                </div>
            </div>
            
            <!-- FAQ 3 -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <button class="w-full flex items-start justify-between text-left" onclick="toggleFAQ(this)">
                    <h3 class="text-lg font-semibold text-gray-900 pr-8">
                        Do you offer technical support?
                    </h3>
                    <i data-feather="chevron-down" class="w-6 h-6 text-gray-400 flex-shrink-0 transition-transform stroke-current"></i>
                </button>
                <div class="faq-answer mt-4 text-gray-600 hidden">
                    Yes! We provide 24/7 technical support for all paid plans. Premium and Enterprise customers receive priority support with dedicated account managers. Free plan users can access email support during business hours.
                </div>
            </div>
            
            <!-- FAQ 4 -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <button class="w-full flex items-start justify-between text-left" onclick="toggleFAQ(this)">
                    <h3 class="text-lg font-semibold text-gray-900 pr-8">
                        What information should I include in my message?
                    </h3>
                    <i data-feather="chevron-down" class="w-6 h-6 text-gray-400 flex-shrink-0 transition-transform stroke-current"></i>
                </button>
                <div class="faq-answer mt-4 text-gray-600 hidden">
                    Please include your company size, industry, current challenges, and what you hope to achieve with PEANECH ERP. The more details you provide, the better we can tailor our response to your specific needs.
                </div>
            </div>
            
            <!-- FAQ 5 -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <button class="w-full flex items-start justify-between text-left" onclick="toggleFAQ(this)">
                    <h3 class="text-lg font-semibold text-gray-900 pr-8">
                        Can I visit your office without an appointment?
                    </h3>
                    <i data-feather="chevron-down" class="w-6 h-6 text-gray-400 flex-shrink-0 transition-transform stroke-current"></i>
                </button>
                <div class="faq-answer mt-4 text-gray-600 hidden">
                    While walk-ins are welcome, we recommend scheduling an appointment to ensure one of our specialists is available to assist you. This also allows us to prepare for your specific needs and questions.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600 text-white relative overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0">
        <div class="absolute w-96 h-96 bg-white/10 rounded-full blur-3xl top-0 left-1/4 animate-pulse"></div>
        <div class="absolute w-96 h-96 bg-white/10 rounded-full blur-3xl bottom-0 right-1/4 animate-pulse delay-1000"></div>
    </div>
    
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
            Ready to Get Started?
        </h2>
        <p class="text-xl md:text-2xl text-blue-100 mb-12">
            Try PEANECH ERP free for 30 days—no credit card required
        </p>
        
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/register" class="w-full sm:w-auto px-8 py-4 bg-white text-blue-600 font-semibold rounded-lg shadow-2xl hover:shadow-3xl hover:scale-105 transition-all flex items-center justify-center">
                <i data-feather="zap" class="w-5 h-5 mr-2 stroke-current"></i>
                Start Free Trial
            </a>
            <a href="/pricing" class="w-full sm:w-auto px-8 py-4 bg-white/20 backdrop-blur-sm text-white font-semibold rounded-lg border-2 border-white/30 hover:bg-white/30 transition-all flex items-center justify-center">
                <i data-feather="tag" class="w-5 h-5 mr-2 stroke-current"></i>
                View Pricing
            </a>
        </div>
    </div>
</section>

<script>
// FAQ toggle functionality
function toggleFAQ(button) {
    const answer = button.nextElementSibling;
    const icon = button.querySelector('i[data-feather="chevron-down"]');
    
    // Close all other FAQs
    document.querySelectorAll('.faq-answer').forEach(a => {
        if (a !== answer) {
            a.classList.add('hidden');
            a.previousElementSibling.querySelector('i').style.transform = 'rotate(0deg)';
        }
    });
    
    // Toggle current FAQ
    answer.classList.toggle('hidden');
    if (answer.classList.contains('hidden')) {
        icon.style.transform = 'rotate(0deg)';
    } else {
        icon.style.transform = 'rotate(180deg)';
    }
}

// Contact form submission
document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Here you would normally send the form data to your backend
    // For now, we'll just show a success message
    
    alert('Thank you for contacting us! We will get back to you within 24 hours.');
    this.reset();
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout/user_layout.php';
?>
