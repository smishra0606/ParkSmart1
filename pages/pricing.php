<?php
require_once '../includes/db_connect.php';
require_once '../includes/functions.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing - ParkSmart</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <section class="page-header">
        <div class="container">
            <h1>Simple, Transparent Pricing</h1>
            <p>Choose the best plan for your parking management needs</p>
        </div>
    </section>

    <section class="pricing-tabs">
        <div class="container">
            <div class="tab-container">
                <div class="tabs">
                    <button class="tab-btn active" onclick="switchTab('monthly')">Monthly Billing</button>
                    <button class="tab-btn" onclick="switchTab('yearly')">Annual Billing <span class="badge">Save 20%</span></button>
                </div>
                
                <div id="monthly" class="tab-content active">
                    <div class="pricing-grid">
                        <div class="pricing-card">
                            <div class="pricing-header">
                                <h3>Starter</h3>
                                <div class="price">
                                    <span class="currency">$</span>
                                    <span class="amount">49</span>
                                    <span class="period">/month</span>
                                </div>
                                <p class="pricing-subtitle">Perfect for small parking lots</p>
                            </div>
                            <div class="pricing-features">
                                <ul>
                                    <li>Up to 50 parking spaces</li>
                                    <li>Basic analytics</li>
                                    <li>Email support</li>
                                    <li>Mobile responsive</li>
                                    <li>Payment processing</li>
                                    <li class="unavailable">Advanced reporting</li>
                                    <li class="unavailable">API access</li>
                                    <li class="unavailable">Custom branding</li>
                                </ul>
                            </div>
                            <div class="pricing-cta">
                                <a href="register.php" class="btn btn-outline">Get Started</a>
                            </div>
                        </div>
                        
                        <div class="pricing-card featured">
                            <div class="ribbon">Most Popular</div>
                            <div class="pricing-header">
                                <h3>Professional</h3>
                                <div class="price">
                                    <span class="currency">$</span>
                                    <span class="amount">99</span>
                                    <span class="period">/month</span>
                                </div>
                                <p class="pricing-subtitle">For growing operations</p>
                            </div>
                            <div class="pricing-features">
                                <ul>
                                    <li>Up to 200 parking spaces</li>
                                    <li>Advanced analytics</li>
                                    <li>Priority support</li>
                                    <li>SMS notifications</li>
                                    <li>Payment processing</li>
                                    <li>Advanced reporting</li>
                                    <li>API access</li>
                                    <li class="unavailable">Custom branding</li>
                                </ul>
                            </div>
                            <div class="pricing-cta">
                                <a href="register.php" class="btn btn-primary">Get Started</a>
                            </div>
                        </div>
                        
                        <div class="pricing-card">
                            <div class="pricing-header">
                                <h3>Enterprise</h3>
                                <div class="price">
                                    <span class="currency">$</span>
                                    <span class="amount">249</span>
                                    <span class="period">/month</span>
                                </div>
                                <p class="pricing-subtitle">For large-scale facilities</p>
                            </div>
                            <div class="pricing-features">
                                <ul>
                                    <li>Unlimited parking spaces</li>
                                    <li>Custom analytics</li>
                                    <li>24/7 dedicated support</li>
                                    <li>SMS & email notifications</li>
                                    <li>Payment processing</li>
                                    <li>Advanced reporting</li>
                                    <li>API access</li>
                                    <li>Custom branding</li>
                                </ul>
                            </div>
                            <div class="pricing-cta">
                                <a href="#contact" class="btn btn-outline">Contact Sales</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="yearly" class="tab-content">
                    <div class="pricing-grid">
                        <div class="pricing-card">
                            <div class="pricing-header">
                                <h3>Starter</h3>
                                <div class="price">
                                    <span class="currency">$</span>
                                    <span class="amount">39</span>
                                    <span class="period">/month</span>
                                </div>
                                <p class="pricing-subtitle">Perfect for small parking lots</p>
                                <p class="pricing-save">Billed annually ($468/year)</p>
                            </div>
                            <div class="pricing-features">
                                <ul>
                                    <li>Up to 50 parking spaces</li>
                                    <li>Basic analytics</li>
                                    <li>Email support</li>
                                    <li>Mobile responsive</li>
                                    <li>Payment processing</li>
                                    <li class="unavailable">Advanced reporting</li>
                                    <li class="unavailable">API access</li>
                                    <li class="unavailable">Custom branding</li>
                                </ul>
                            </div>
                            <div class="pricing-cta">
                                <a href="register.php" class="btn btn-outline">Get Started</a>
                            </div>
                        </div>
                        
                        <div class="pricing-card featured">
                            <div class="ribbon">Most Popular</div>
                            <div class="pricing-header">
                                <h3>Professional</h3>
                                <div class="price">
                                    <span class="currency">$</span>
                                    <span class="amount">79</span>
                                    <span class="period">/month</span>
                                </div>
                                <p class="pricing-subtitle">For growing operations</p>
                                <p class="pricing-save">Billed annually ($948/year)</p>
                            </div>
                            <div class="pricing-features">
                                <ul>
                                    <li>Up to 200 parking spaces</li>
                                    <li>Advanced analytics</li>
                                    <li>Priority support</li>
                                    <li>SMS notifications</li>
                                    <li>Payment processing</li>
                                    <li>Advanced reporting</li>
                                    <li>API access</li>
                                    <li class="unavailable">Custom branding</li>
                                </ul>
                            </div>
                            <div class="pricing-cta">
                                <a href="register.php" class="btn btn-primary">Get Started</a>
                            </div>
                        </div>
                        
                        <div class="pricing-card">
                            <div class="pricing-header">
                                <h3>Enterprise</h3>
                                <div class="price">
                                    <span class="currency">$</span>
                                    <span class="amount">199</span>
                                    <span class="period">/month</span>
                                </div>
                                <p class="pricing-subtitle">For large-scale facilities</p>
                                <p class="pricing-save">Billed annually ($2,388/year)</p>
                            </div>
                            <div class="pricing-features">
                                <ul>
                                    <li>Unlimited parking spaces</li>
                                    <li>Custom analytics</li>
                                    <li>24/7 dedicated support</li>
                                    <li>SMS & email notifications</li>
                                    <li>Payment processing</li>
                                    <li>Advanced reporting</li>
                                    <li>API access</li>
                                    <li>Custom branding</li>
                                </ul>
                            </div>
                            <div class="pricing-cta">
                                <a href="#contact" class="btn btn-outline">Contact Sales</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="faq-section">
        <div class="container">
            <h2 class="section-title">Frequently Asked Questions</h2>
            
            <div class="faq-grid">
                <div class="faq-item">
                    <h3>What payment methods do you accept?</h3>
                    <p>We accept all major credit cards including Visa, Mastercard, American Express, and Discover. We also support payments via PayPal.</p>
                </div>
                
                <div class="faq-item">
                    <h3>Can I upgrade or downgrade my plan?</h3>
                    <p>Yes, you can change your plan at any time. When upgrading, we prorate the remaining time on your current plan. When downgrading, the new rate will apply at the next billing cycle.</p>
                </div>
                
                <div class="faq-item">
                    <h3>Is there a contract or commitment?</h3>
                    <p>No, all our plans are month-to-month or year-to-year with no long-term contracts. You can cancel anytime without penalties.</p>
                </div>
                
                <div class="faq-item">
                    <h3>Do you offer a free trial?</h3>
                    <p>Yes, we offer a 14-day free trial on all plans. No credit card required during the trial period.</p>
                </div>
                
                <div class="faq-item">
                    <h3>How do I get started with implementation?</h3>
                    <p>After signing up, our onboarding team will reach out to guide you through the setup process. Typical implementation takes 1-3 days depending on the size of your facility.</p>
                </div>
                
                <div class="faq-item">
                    <h3>What kind of support do you provide?</h3>
                    <p>All plans include email support with varying response times. Professional and Enterprise plans include phone support and dedicated account managers.</p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="comparison-section">
        <div class="container">
            <h2 class="section-title">Plan Comparison</h2>
            
            <div class="table-responsive">
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th>Features</th>
                            <th>Starter</th>
                            <th>Professional</th>
                            <th>Enterprise</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Parking Spaces</td>
                            <td>Up to 50</td>
                            <td>Up to 200</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td>User Accounts</td>
                            <td>3</td>
                            <td>10</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td>Analytics Dashboard</td>
                            <td>Basic</td>
                            <td>Advanced</td>
                            <td>Custom</td>
                        </tr>
                        <tr>
                            <td>Support Response Time</td>
                            <td>48 hours</td>
                            <td>24 hours</td>
                            <td>4 hours</td>
                        </tr>
                        <tr>
                            <td>Phone Support</td>
                            <td><i class="fas fa-times"></i></td>
                            <td><i class="fas fa-check"></i></td>
                            <td><i class="fas fa-check"></i></td>
                        </tr>
                        <tr>
                            <td>API Access</td>
                            <td><i class="fas fa-times"></i></td>
                            <td><i class="fas fa-check"></i></td>
                            <td><i class="fas fa-check"></i></td>
                        </tr>
                        <tr>
                            <td>Custom Branding</td>
                            <td><i class="fas fa-times"></i></td>
                            <td><i class="fas fa-times"></i></td>
                            <td><i class="fas fa-check"></i></td>
                        </tr>
                        <tr>
                            <td>Data Retention</td>
                            <td>3 months</td>
                            <td>1 year</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td>SMS Notifications</td>
                            <td><i class="fas fa-times"></i></td>
                            <td><i class="fas fa-check"></i></td>
                            <td><i class="fas fa-check"></i></td>
                        </tr>
                        <tr>
                            <td>Priority Support</td>
                            <td><i class="fas fa-times"></i></td>
                            <td><i class="fas fa-check"></i></td>
                            <td><i class="fas fa-check"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to optimize your parking operations?</h2>
                <p>Join thousands of businesses that trust our parking management solution.</p>
                <div class="cta-buttons">
                    <a href="register.php" class="btn btn-primary">Get Started Today</a>
                    <a href="#contact" class="btn btn-secondary">Talk to Sales</a>
                </div>
            </div>
        </div>
    </section>

    <?php include '../includes/footer.php'; ?>
    
    <script src="../assets/js/main.js"></script>
    <script>
        function switchTab(tabName) {
            // Hide all tab content
            const tabContents = document.getElementsByClassName('tab-content');
            for (let i = 0; i < tabContents.length; i++) {
                tabContents[i].classList.remove('active');
            }
            
            // Deactivate all tab buttons
            const tabButtons = document.getElementsByClassName('tab-btn');
            for (let i = 0; i < tabButtons.length; i++) {
                tabButtons[i].classList.remove('active');
            }
            
            // Show the selected tab content
            document.getElementById(tabName).classList.add('active');
            
            // Activate the clicked tab button
            event.currentTarget.classList.add('active');
        }
    </script>
</body>
</html>
