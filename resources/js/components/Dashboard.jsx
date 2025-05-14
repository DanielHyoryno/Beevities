import React, { useState, useEffect } from "react";
import { Button } from "./ui/Button";
import { Card, CardContent } from "./ui/Card";
import "../../css/app.css";

function Dashboard() {
    console.log("Dashboard function called");

    const [data, setData] = useState({
        user: "Guest",
        organization_route: "/organizations",
        cart_route: "/user/cart",
    });

    const [events] = useState([
        {
            id: 1,
            image: "/assets/tech_up.jpg",
            date: "Mar 22, 2025",
            title: "Tech Up",
            desc: "Join us for a day of innovation, technology, and networking.",
            price: "Free",
            button: "Get Ticket",
        },
        {
            id: 2,
            image: "/assets/kat_bdm.jpg",
            date: "Mar 20, 2025",
            title: "KAT 9.0",
            desc: "Annual & Biggest concert of BDM",
            price: "Rp 160.000",
            button: "Get Ticket",
        },
        {
            id: 3,
            image: "/assets/caving.jpeg",
            date: "Mar 25, 2025",
            title: "Perjalanan Divisi Caving",
            desc: "Caving is fun!!",
            price: "Free",
            button: "Register",
        },
    ]);

    const [organizations] = useState([
        {
            id: 1,
            logo: "/assets/bncc.png",
            title: "Bina Nusantara Computer Club",
            desc: "Exploring technology and innovation",
        },
        {
            id: 2,
            logo: "/assets/bdm.png",
            title: "Bersama Dalam Musik",
            desc: "BDM! BDM! BDM!",
        },
        {
            id: 3,
            logo: "/assets/himti.png",
            title: "Himpunan Teknik Informatika",
            desc: "Creative expression and culture",
        },
        {
            id: 4,
            logo: "/assets/swanarapala.png",
            title: "Swanarapala",
            desc: "Athletics and team sports",
        },
    ]);

    useEffect(() => {
        console.log("useEffect triggered");
        if (window.dashboardData) {
            setData(window.dashboardData);
        }
    }, []);

    // ===== HERO SECTION =====
    const Hero = ({ organizationRoute }) => {
        console.log("Rendering Hero");
        return (
            <section
                className="w-100 py-5 bg-primary text-white shadow-lg"
                style={{
                    background: "linear-gradient(to right, #2563EB, #1E40AF)",
                    borderRadius: "0",
                }}
            >
                <div className="container">
                    <div className="row align-items-center justify-content-center text-center text-md-start">
                        <div className="col-12 col-md-6 mb-4 mb-md-0">
                            <h1 className="display-6 fw-bold">
                                Discover BINUS Organizations & Events
                            </h1>
                            <p className="fs-6">
                                Connect with your community, participate in
                                events, and explore opportunities.
                            </p>
                            <div className="d-flex flex-column flex-md-row justify-content-center justify-content-md-start gap-3 mt-4">
                                <Button
                                    className="btn"
                                    style={{
                                        backgroundColor: "#F97316",
                                        color: "white",
                                        border: "none",
                                        borderRadius: "8px",
                                        padding: "12px 30px",
                                        fontSize: "16px",
                                    }}
                                >
                                    Browse Events
                                </Button>
                                <Button
                                    className="btn"
                                    style={{
                                        backgroundColor: "white",
                                        color: "#2563EB",
                                        border: "1px solid #2563EB",
                                        borderRadius: "8px",
                                        padding: "12px 30px",
                                        fontSize: "16px",
                                    }}
                                    asChild
                                    href={organizationRoute}
                                >
                                    Join Organizations
                                </Button>
                            </div>
                        </div>
                        <div className="col-10 col-md-6">
                            <img
                                src="/assets/img_hero.jpg"
                                alt="Community Illustration"
                                className="img-fluid rounded"
                                style={{
                                    maxHeight: "400px",
                                    objectFit: "cover",
                                    width: "100%",
                                }}
                            />
                        </div>
                    </div>
                </div>
            </section>
        );
    };

    // ===== FEATURED EVENTS SECTION =====
    const FeaturedEvents = ({ events }) => {
        console.log("Rendering FeaturedEvents", events);
        return (
            <section className="container py-5">
                <div className="d-flex justify-content-between align-items-center mb-4">
                    <h2 className="h3 fw-bold">Featured Events</h2>
                    <a
                        href="#"
                        className="text-primary text-decoration-underline"
                    >
                        View All Events
                    </a>
                </div>
                <div className="row row-cols-1 row-cols-md-3 g-4">
                    {events.map((event) => (
                        <div key={event.id} className="col">
                            <Card className="card h-100">
                                <img
                                    src={event.image}
                                    alt={event.title}
                                    className="card-img-top"
                                    style={{
                                        height: "10rem",
                                        objectFit: "cover",
                                    }}
                                />
                                <CardContent className="card-body d-flex flex-column">
                                    <div className="d-flex align-items-center text-muted small mb-2">
                                        <span className="me-2">📅</span>
                                        {event.date}
                                    </div>
                                    <h3 className="card-title h5 fw-bold">
                                        {event.title}
                                    </h3>
                                    <p className="card-text text-muted small flex-grow-1">
                                        {event.desc}
                                    </p>
                                    <div className="d-flex justify-content-between align-items-center mt-auto">
                                        <span className="fw-semibold text-primary">
                                            {event.price}
                                        </span>
                                        <Button
                                            className="btn btn-primary btn-sm"
                                            asChild
                                            href={`/events/${event.id}`}
                                        >
                                            {event.button}
                                        </Button>
                                    </div>
                                </CardContent>
                            </Card>
                        </div>
                    ))}
                </div>
            </section>
        );
    };

    // ===== ORGANIZATIONS SECTION =====
    const Organizations = ({ organizations }) => {
        console.log("Rendering Organizations", organizations);
        return (
            <section className="container py-5">
                <div className="d-flex justify-content-between align-items-center mb-4">
                    <h2 className="h3 fw-bold">Organizations</h2>
                    <a
                        href="/organizations"
                        className="text-primary text-decoration-underline"
                    >
                        View All
                    </a>
                </div>
                <div className="row row-cols-1 row-cols-md-4 g-4">
                    {organizations.map((org) => (
                        <div key={org.id} className="col">
                            <Card className="card h-100 text-center">
                                <CardContent className="card-body d-flex flex-column align-items-center">
                                    <div
                                        className="mb-3"
                                        style={{
                                            width: "100%",
                                            height: "6rem",
                                            display: "flex",
                                            alignItems: "center",
                                            justifyContent: "center",
                                            backgroundColor: "#f8f9fa",
                                            borderRadius: "10px",
                                            overflow: "hidden",
                                        }}
                                    >
                                        <img
                                            src={org.logo}
                                            alt={org.title}
                                            style={{
                                                height: "100%",
                                                width: "auto",
                                                objectFit: "contain",
                                            }}
                                        />
                                    </div>
                                    <h4 className="card-title h6 fw-semibold">
                                        {org.title}
                                    </h4>
                                    <p className="card-text text-muted small flex-grow-1">
                                        {org.desc}
                                    </p>
                                    <Button className="btn btn-primary btn-sm mt-auto w-100">
                                        View More
                                    </Button>
                                </CardContent>
                            </Card>
                        </div>
                    ))}
                </div>
            </section>
        );
    };

    // ===== FOOTER SECTION =====
    const Footer = () => {
        console.log("Rendering Footer");
        return (
            <footer className="bg-dark text-white py-5 rounded-3 mt-5">
                <div className="container">
                    <div className="row g-4">
                        <div className="col-md-3">
                            <h3 className="h4 fw-bold mb-3">BEEVITIES</h3>
                            <p className="small">
                                Connecting BINUS community through events and
                                organizations.
                            </p>
                        </div>
                        <div className="col-md-3">
                            <h4 className="h5 fw-semibold mb-3">Quick Links</h4>
                            <ul className="list-unstyled small">
                                <li>
                                    <a
                                        href="#"
                                        className="text-white text-decoration-none"
                                    >
                                        About Us
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        className="text-white text-decoration-none"
                                    >
                                        Organizations
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        className="text-white text-decoration-none"
                                    >
                                        Events
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        className="text-white text-decoration-none"
                                    >
                                        Store
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div className="col-md-3">
                            <h4 className="h5 fw-semibold mb-3">Support</h4>
                            <ul className="list-unstyled small">
                                <li>
                                    <a
                                        href="#"
                                        className="text-white text-decoration-none"
                                    >
                                        Help Center
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        className="text-white text-decoration-none"
                                    >
                                        Terms of Service
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        className="text-white text-decoration-none"
                                    >
                                        Privacy Policy
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        className="text-white text-decoration-none"
                                    >
                                        Contact Us
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div className="col-md-3">
                            <h4 className="h5 fw-semibold mb-3">
                                Connect With Us
                            </h4>
                            <div className="d-flex gap-3 small">
                                <a
                                    href="#"
                                    className="text-white text-decoration-none"
                                >
                                    Instagram
                                </a>
                                <a
                                    href="#"
                                    className="text-white text-decoration-none"
                                >
                                    Twitter
                                </a>
                                <a
                                    href="#"
                                    className="text-white text-decoration-none"
                                >
                                    LinkedIn
                                </a>
                                <a
                                    href="#"
                                    className="text-white text-decoration-none"
                                >
                                    Facebook
                                </a>
                            </div>
                        </div>
                    </div>
                    <div className="text-center small text-muted mt-5">
                        © 2025 BEEVITIES. All rights reserved.
                    </div>
                </div>
            </footer>
        );
    };

    console.log("Rendering Dashboard return");
    return (
        <main className="py-6">
            <Hero organizationRoute={data.organization_route} />
            <FeaturedEvents events={events} />
            <Organizations organizations={organizations} />
            <Footer />
        </main>
    );
}

export default Dashboard;
