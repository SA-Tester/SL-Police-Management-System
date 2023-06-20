import React from "react"
import { Link } from "react-router-dom";

const Payroll = () => {
    return (
        <div>
            <table>
                <tr>
                    <td><Link to="/CalculateSalaries">Calculate Salaries</Link></td>
                </tr>
                <tr>
                    <td><Link to="/SendSalaries">Send Salaries</Link></td>
                </tr>
            </table>
        </div>
    );
};

export default Payroll;