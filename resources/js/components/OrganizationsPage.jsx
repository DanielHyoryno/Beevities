// import React, { useState, useEffect } from "react";
// import { Link } from "react-router-dom";
// import { Button } from "./ui/Button";
// import { Card, CardContent } from "./ui/Card";

// function SearchBar({ onSearch }) {
//     return (
//         <div
//             className="bg-primary py-4"
//             style={{
//                 background: "linear-gradient(90deg, #2563EB 0%, #1E40AF 100%)",
//             }}
//         >
//             <div className="container">
//                 <input
//                     type="text"
//                     className="form-control form-control-lg"
//                     placeholder="Search organizations..."
//                     onChange={(e) => onSearch(e.target.value)}
//                     style={{ borderRadius: "10px" }}
//                 />
//             </div>
//         </div>
//     );
// }

// function OrganizationCard({ org }) {
//     return (
//         <div className="col">
//             <Card className="card h-100 text-center">
//                 <CardContent className="card-body d-flex flex-column align-items-center">
//                     <div
//                         className="mb-3"
//                         style={{
//                             width: "100%",
//                             height: "6rem",
//                             display: "flex",
//                             alignItems: "center",
//                             justifyContent: "center",
//                             backgroundColor: "#f8f9fa",
//                             borderRadius: "10px",
//                             overflow: "hidden",
//                         }}
//                     >
//                     </div>
//                     <h4 className="card-title h6 fw-semibold">{org.name}</h4>
//                     <p className="card-text text-muted small flex-grow-1">
//                         {org.description.length > 80
//                             ? `${org.description.substring(0, 80)}...`
//                             : org.description}
//                     </p>
//                     <Link
//                         to={`/organizations/${org.id}`}
//                         className="btn btn-primary btn-sm mt-auto w-100"
//                     >
//                         View More
//                     </Link>
//                 </CardContent>
//             </Card>
//         </div>
//     );
// }

// export default function OrganizationsPage() {
//     const [organizations, setOrganizations] = useState([]);
//     const [filteredOrganizations, setFilteredOrganizations] = useState([]);
//     const [searchTerm, setSearchTerm] = useState("");

//     useEffect(() => {
//         console.log("OrganizationsPage.jsx rendered", window.organizationsData);
//         if (window.organizationsData) {
//             console.log("Data received:", window.organizationsData);
//             setOrganizations(window.organizationsData);
//             setFilteredOrganizations(window.organizationsData);
//         } else {
//             console.error("No organizations data found");
//             setOrganizations([
//                 // {
//                 //     id: 1,
//                 //     logo: "/assets/bncc.png",
//                 //     name: "Bina Nusantara Computer Club",
//                 //     description: "Exploring technology and innovation",
//                 // },
//             ]);
//             setFilteredOrganizations([]);
//         }
//     }, []);

//     useEffect(() => {
//         const filtered = organizations.filter((org) =>
//             org.name?.toLowerCase().includes(searchTerm.toLowerCase())
//         );
//         setFilteredOrganizations(filtered);
//     }, [searchTerm, organizations]);

//     return (
//         <div className="organizations-page">
//             <SearchBar onSearch={setSearchTerm} />
//             <section className="container py-5">
//                 <div className="d-flex justify-content-between align-items-center mb-4">
//                     <h2 className="h3 fw-bold">Organizations</h2>
//                 </div>
//                 {filteredOrganizations.length === 0 ? (
//                     <div className="alert alert-warning text-center">
//                         No organizations found
//                     </div>
//                 ) : (
//                     <div className="row row-cols-1 row-cols-md-4 g-4">
//                         {filteredOrganizations.map((org) => (
//                             <OrganizationCard key={org.id} org={org} />
//                         ))}
//                     </div>
//                 )}
//             </section>
//         </div>
//     );
// }


import React, { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import { Button } from "./ui/Button";
import { Card, CardContent } from "./ui/Card";

function SearchBar({ onSearch }) {
    return (
        <div
            className="bg-primary py-4"
            style={{
                background: "linear-gradient(90deg, #2563EB 0%, #1E40AF 100%)",
            }}
        >
            <div className="container">
                <input
                    type="text"
                    className="form-control form-control-lg"
                    placeholder="Search organizations..."
                    onChange={(e) => onSearch(e.target.value)}
                    style={{ borderRadius: "10px" }}
                />
            </div>
        </div>
    );
}

function OrganizationCard({ org }) {
    return (
        <div className="col">
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
                            src={org.logo || "/placeholder.png"}
                            alt={org.name}
                            style={{
                                height: "100%",
                                width: "auto",
                                objectFit: "contain",
                            }}
                        />
                    </div>
                    <h4 className="card-title h6 fw-semibold">{org.name}</h4>
                    <p className="card-text text-muted small flex-grow-1">
                        {org.description.length > 80
                            ? `${org.description.substring(0, 80)}...`
                            : org.description}
                    </p>
                    <Link
                        to={`/organizations/${org.id}`}
                        className="btn btn-primary btn-sm mt-auto w-100"
                    >
                        View More
                    </Link>
                </CardContent>
            </Card>
        </div>
    );
}

export default function OrganizationsPage() {
    const [organizations, setOrganizations] = useState([]);
    const [filteredOrganizations, setFilteredOrganizations] = useState([]);
    const [searchTerm, setSearchTerm] = useState("");

    useEffect(() => {
        console.log("OrganizationsPage.jsx useEffect running");
        console.log("window.organizationsData:", window.organizationsData);
        if (window.organizationsData) {
            console.log("Data received:", window.organizationsData);
            setOrganizations(window.organizationsData);
            setFilteredOrganizations(window.organizationsData);
        } else {
            console.error("No organizations data found");
            setOrganizations([]);
            setFilteredOrganizations([]);
        }
    }, []);

    useEffect(() => {
        const filtered = organizations.filter((org) =>
            org.name?.toLowerCase().includes(searchTerm.toLowerCase())
        );
        setFilteredOrganizations(filtered);
    }, [searchTerm, organizations]);

    return (
        <div className="organizations-page">
            <SearchBar onSearch={setSearchTerm} />
            <section className="container py-5">
                <div className="d-flex justify-content-between align-items-center mb-4">
                    <h2 className="h3 fw-bold">Organizations</h2>
                </div>
                {filteredOrganizations.length === 0 ? (
                    <div className="alert alert-warning text-center">
                        No organizations found
                    </div>
                ) : (
                    <div className="row row-cols-1 row-cols-md-4 g-4">
                        {filteredOrganizations.map((org) => (
                            <OrganizationCard key={org.id} org={org} />
                        ))}
                    </div>
                )}
            </section>
        </div>
    );
}