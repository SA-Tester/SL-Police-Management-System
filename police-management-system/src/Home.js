import React from "react"

import { Link } from "react-router-dom";

const Home = () => {
    return (
        <div>
            <table>
                <tr>
                    <td><Link to="/Complaints">Complaints</Link></td>
                    <td><Link to="/Duties">Duties</Link></td>
                    <td><Link to="/Leaves">Leaves</Link></td>
                </tr>
                <tr>
                    <td><a href="/Payroll">Payroll</a></td>
                    <td><a href="/Employees">Employees</a></td>
                    <td><a href="/Settings">Settings</a></td>
                </tr>
            </table>
        </div>
    );
};

export default Home;
