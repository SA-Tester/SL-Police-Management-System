import React from "react"
import {Link} from "react-router-dom"

const Complaints = () => {
    return (
        <div>
            <table>
                <tr>
                    <td><Link to="complaints/RecordComplaints">Record Complaints</Link></td>
                    <td><a href="">View People</a></td>
                </tr>
                <tr>
                    <td><a href="">View Complaint Status</a></td>
                    <td><a href="">Complaint Study</a></td>
                </tr>
            </table>
        </div>
    );
};

export default Complaints;

