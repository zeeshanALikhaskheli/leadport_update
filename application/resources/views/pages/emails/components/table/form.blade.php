<div class="card count" id="ai-email-parser-wrapper">
    <div class="card-body">
        <h4 class="card-title">AI Email Parser</h4>
        <div class="parser-details">
            <p>Fetching required emails and app password from the user table...</p>
            
            <!-- Form to submit app password -->
            <form method="POST" action="{{ route('user.updateAppPassword') }}">
                @csrf
                <div class="form-group" style="max-width: 400px;">
                    <label for="userEmail">User Email</label>
                    <input type="email" id="userEmail" class="form-control" value="{{ Auth::user()->email }}" disabled>
                </div>

                <div class="form-group" style="max-width: 400px;">
                    <label for="appPassword">App Password</label>
                    <p style="font-size: 0.9em; color: gray;">
                        (Step: Generate an app password from your Gmail account by following the instructions below)
                    </p>
                    <ul style="font-size: 0.9em; color: gray;">
                        <li>Go to <a href="https://myaccount.google.com/security" target="_blank">Gmail Security</a> settings.</li>
                        <li>Enable <strong>2-step verification</strong> if you haven't already.</li>
                        <li>Under "App passwords", create a password specifically for email access.</li>
                        <li>Copy the generated app password and paste it into the field below.</li>
                    </ul>
                    <input type="password" name="app_password" id="appPassword" class="form-control" placeholder="Enter your app password" required>
                </div>

                <button type="submit" class="btn btn-success">Save App Password</button>
            </form>
        </div>
    </div>
</div>
