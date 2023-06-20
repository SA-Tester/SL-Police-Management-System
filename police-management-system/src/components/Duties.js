import React from "react"
import { Link } from "react-router-dom";

const Duties = () => {
    return (
        <div>
            <table>
                <tr>
                    <td><Link to="/GeneralDuties">General Duties</Link></td>
                    <td><Link to="/SpecialDuties">Special Duties</Link></td>
                </tr>
            </table>
        </div>
    );
};

export default Duties;