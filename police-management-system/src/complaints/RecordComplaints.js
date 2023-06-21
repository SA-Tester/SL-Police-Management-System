import "../App.css";
import logo from "../logo.svg";

function UI(){
    return(
        <div>
            <div id="head">
                <div id="left"><img id="logo" src={logo}/></div>
                <div id="mid"><h1>Record a Complaint</h1></div>
                <div id="right"><h3>20th June 2023</h3></div>
            </div>
            <div id="body">
                <form method="" action="" encType="multipart/formdata">
                    <table id="table" border="0">
                        <tr>
                            <td>Date</td>
                            <td><input type="date" name="date"/></td>
                        </tr>
                        <tr>
                            <td>Complaint Type</td>
                            <td>
                                <select name="complaintType">
                                    <option value="1">Abuse of Women or Children</option>
                                    <option value="2">Appreciation</option>
                                    <option value="3">Archeological Issue</option>
                                    <option value="4">Assault</option>
                                    <option value="5">Bribary and Corruption</option>
                                    <option value="6">Complaint Against Police</option>
                                    <option value="7">Criminal Offence</option>
                                    <option value="8">Cybercrime</option>
                                    <option value="9">Demonstation/Protest/Strike</option>
                                    <option value="10">Environmental Issue</option>
                                    <option value="11">Exchange Fault</option>
                                    <option value="12">Foreign Employement Issue</option>
                                    <option value="13">Frauds/Cheating</option>
                                    <option value="14">House Breaking</option>
                                    <option value="15">Illegal Mining</option>
                                    <option value="16">Industrial/ Labour Dispute</option>
                                    <option value="17">Information</option>
                                    <option value="18">Intellectual Propety Dispute</option>
                                    <option value="19">Miscellaneous</option>
                                    <option value="20">Mischeif/ Sabotage</option>
                                    <option value="21">Murder</option>
                                    <option value="22">Narcotics/Dangerous Drugs</option>
                                    <option value="23">National Security</option>
                                    <option value="24">Natural Disaster</option>
                                    <option value="25">Offence/ Act Against Public Health</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td><input type="text" name="name"/></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><input type="text" name="address"/></td>
                        </tr>
                        <tr>
                            <td>National Identity Card (NIC)</td>
                            <td><input type="text" name="nic"/></td>
                        </tr>
                        <tr>
                            <td>Contact Number</td>
                            <td><input type="text" name="tel"/></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="email" name="email"/></td>
                        </tr>
                        <tr>
                            <td>Complaint Title</td>
                            <td><input type="text" name="title"/></td>
                        </tr>
                        <tr>
                            <td>Complaint (Audio)</td>
                            <td>
                                <button name="record">Record</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Complaint (Text)</td>
                            <td>
                                <textarea name="complaintText" rows={25} cols={227}>
                                    Enter Your Complaint
                                </textarea>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" name="submit" value="Submit"/>
                </form>
            </div>
            <div id="footer">

            </div>
        </div>
    );
}

export default function RecordComplaints(){
    return(
        UI()
    );    
}