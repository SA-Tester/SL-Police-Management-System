import React from "react"
import { Link } from "react-router-dom";

const Leaves = () => {
    return (
        <div>
            <table>
                <tr>
                    <td><Link to="/RequestLeave">Request Leaves</Link></td>
                    <td><Link to="/SubmitMedicals">Submit Medicals</Link></td>
                </tr>
            </table>
        </div>
    );
};

export default Leaves;