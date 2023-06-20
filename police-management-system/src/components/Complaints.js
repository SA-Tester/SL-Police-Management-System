import React from "react"
import {Link} from "react-router-dom";

const Complaints = () => {
    return (
            <div>
                <table>
                    <tr>
                        <td><Link to="/RecordComplaints">Record Complaints</Link></td>
                        <td><Link to="/ViewPeople">View People</Link></td>
                    </tr>
                    <tr>
                        <td><Link to="/ComplaintStatus">Complaint Stauts</Link></td>
                        <td><Link to="/ComplaintStudies">Complaint Studies</Link></td>
                    </tr>
                </table>
            </div>
    );
};

export default Complaints;